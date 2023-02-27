<h1>Contactos</h1>

<?php foreach ($contacts as $contact): ?>
    <div>
        <?= $contact->name ?> <?= $contact->phone_number ?>
    </div>
<?php endforeach ?>