<?php 
/*
Template Name: newdemande
*/
?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
<div class="marquis">
    <h1>FORMULAIRE VISA TOURISME</h1>
    <p>Remplissez ce formulaire d’obtention de visa tourisme en 3 étapes pour nous faire parvenir votre demande que nous traiterons dans les plus brefs délais</p>
</div>
<div class="steps">
    <div class="step active">
        <span>1</span>
        <i></i>
        <span>IDENTITÉ DU DEMANDEUR</span>
    </div>
    <div class="step">
        <span>2</span>
        <i></i>
        <span>SITUATION DU DEMANDEUR</span>
    </div>
    <div class="step">
        <span>3</span>
        <i></i>
        <span>CONFIGURATION DU SÉJOUR</span>
    </div>
</div>

<div class="site-main">
    <div class="title">
        <span>1.</span>
        <h2>Renseigner l'indentité du demandeur</h2>
    </div>
    <div class="visa-form" role="main">
        <?php acf_form(array(
            'post_id'		=> 'new_post',
            'fields'        => array('nom','prenom', 'email', 'date_de_depart', 'date_de_retour'),
            'new_post'		=> array(
                'post_type'		=> 'demande',
                'post_status'		=> 'publish'
            ),
            'submit_value'		=> 'Faire une demande de visa'
        )); ?>
    </div>
</div>

<?php get_footer(); ?>