<!DOCTYPE html>
<html>
<head>
    <title>Notes <?= esc($type) ?></title>
</head>
<body>

<h1>Notes - <?= esc($type) ?></h1>

<?php if (!empty($notes)): ?>
    <table border="1">
        <tr>
            <th>Étudiant</th>
            <th>Matière</th>
            <th>Note</th>
        </tr>

        <?php foreach ($notes as $note): ?>
            <tr>
                <td><?= esc($note['nom']) ?></td>
                <td><?= esc($note['intituleMatiere'] ?? '-') ?></td>
                <td><?= esc($note['valeurNote'] ?? $note['moyenne']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucune donnée</p>
<?php endif; ?>

</body>
</html>