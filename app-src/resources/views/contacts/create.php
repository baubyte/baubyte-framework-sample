<h1>Crear Contacto</h1>
<form method="POST" action="/contacts" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input value="<?= old('name') ?>" name="name" type="text" class="form-control">
    <div class="text-danger"><?= error('name') ?></div>
  </div>

  <div class="mb-3">
    <label class="form-label">Numero de Teléfono</label>
    <input value="<?= old('phone_number') ?>" name="phone_number" type="text" class="form-control">
    <div class="text-danger"><?= error('phone_number') ?></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Imagen de Perfil</label>
    <input type="file" name="profile" id="profile">
    <div class="text-danger"><?= error('profile') ?></div>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>