<h1>Registro</h1>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input value="<?=old('email')?>" name="email" type="text" class="form-control">
    <div class="text-danger"><?=error('email')?></div>
  </div>

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input value="<?=old('name')?>" name="name" type="text" class="form-control">
    <div class="text-danger"><?=error('name')?></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input value="<?=old('password')?>" name="password" type="password" class="form-control">
    <div class="text-danger"><?=error('password')?></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Password Confirm</label>
    <input value="<?=old('confirm_password')?>" name="confirm_password" type="password" class="form-control">
    <div class="text-danger"><?=error('confirm_password')?></div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
