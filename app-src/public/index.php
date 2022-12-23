<?php
require_once "../vendor/autoload.php";

use Baubyte\App;
use Baubyte\Database\DB;
use Baubyte\Database\Model;
use Baubyte\Http\Middleware;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;
use Baubyte\Validation\Rule;
use Baubyte\Validation\Rules\Required;

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
    return json($request->routeParameters());
});
$app->router->post('/test', function (Request $request) {
    return json($request->data());
});
$app->router->get('/redirect', function (Request $request) {
    return redirect("/test/1");
});
class AuthMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers('Authorization') != 'test') {
            return json(["message" => "Not authenticated"])->setStatus(401);
        }
        $response = $next($request);
        $response->setHeader('X-Test-Custom-Header', 'Hello');
        return $response;
    }
}
class TestMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->setHeader('X-Test-Custom-Two', 'Baubyte');
        return $response;
    }
}
Route::get('/middleware', fn (Request $request) => json(["message" => "ok"]))->setMiddlewares([AuthMiddleware::class, TestMiddleware::class]);

Route::get('/html', fn (Request $request) => view('home', ['user' => 'BAUBYTE']));
Route::post('/validate', fn (Request $request) => json($request->validate(
    [
        'test' => 'required',
        'num' => 'number',
        'email' => 'required_when:num,>,5|email',
    ],['email' => ['required' => 'Falta email']])
));
Route::get('/session', function (Request $request){
    // session()->flash('TEST', 'TEST');
    return json($_SESSION);
});
Route::get('/form', fn(Request $request) => view('form'));
Route::post('/form', function(Request $request){
    return json($request->validate(['email' => 'email', 'name' => 'required']));
});
Route::post('/user', function (Request $request){
    DB::statement("INSERT INTO users (name, email) VALUES (?, ?)", [$request->data('name'),$request->data('email')]);
    return json(["message" => "ok"]);
});
Route::get('/users', function(Request $request){
    return json(DB::statement("SELECT * FROM users;"));
});
class User extends Model {
    protected array $fillable = ["name", "email"];
    protected $insertTimestamps = false;
}
Route::post('/user/model', function(Request $request){
   /* $user = new User();
   $user->name = $request->data('name');
   $user->email = $request->data('email');
   $user->save(); */
   return json(User::create($request->data())->toArray());
});

Route::get('/user/query', function(Request $request){
    /* $user = new User();
    $user->name = $request->data('name');
    $user->email = $request->data('email');
    $user->save(); */
    //return json(User::create($request->data())->toArray());
    //return json(User::first()->toArray());
    //return json(User::find(4)->toArray());
    return json(array_map(fn($model) => $model->toArray(), User::all()));
 });

 Route::post('/user/{id}/update', function (Request $request) {
    $user = User::find($request->routeParameters('id'));

    $user->name = $request->data('name');
    $user->email = $request->data('email');

    return json($user->update()->toArray());
});

Route::delete('/user/{id}/delete', function (Request $request) {
    $user = User::find($request->routeParameters('id'));
    return json($user->delete()->toArray());
});
$app->run();
