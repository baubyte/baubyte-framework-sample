<h1>Contactos</h1>

<?php foreach ($contacts as $contact): ?>
    <div>
        <?= $contact->name ?> <?= $contact->phone_number ?>
        <a href="/contacts/edit/<?= $contact->id ?>">Edit</a>
        <form method="POST" action="/contacts/delete/<?= $contact->id ?>">
            @DELETE
            <button type="submit" class="btn btn-primary">Eliminar</button>
        </form>
    </div>
<?php endforeach ?>