<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $states
 */

// Récupération de l'identité de l'utilisateur connecté
 $identity = $this->getRequest()->getAttribute('identity');
 $identity = $identity ?? [];
 if ($identity) {
    $iduser = $identity["id"];
    $roleuser = $identity["is_superuser"];
    $roleuser_name = $identity["role"];
    }
?>


<div class="row">
    <aside class="column">
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets form content">
            <?= $this->Form->create($sheet) ?>
            <fieldset>
                <legend><?= __("Modifier l'état de la fiche") ?></legend>
                <?php
                // Affichage du champ "Utilisateur" si l'utilisateur n'est pas un comptable
                if ($roleuser_name !== "comptable") {
                    echo $this->Form->control('user_id', ['label' => 'Utilisateur', 'options' => $users, 'empty' => true]);
                } else {
                    // Si l'utilisateur est un comptable, le champ "Utilisateur" est caché et la valeur est fixée à l'ID de l'utilisateur
                    echo $this->Form->hidden('user_id', ['value' => $iduser]);
                }
                // Affichage du champ "État" avec les options disponibles
                echo $this->Form->control('state_id', ['label' => 'État', 'options' => $states]);
                 // Affichage du champ "Fiche validée"
                echo $this->Form->control('sheetvalidated', ['label' => 'Fiche validée']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
