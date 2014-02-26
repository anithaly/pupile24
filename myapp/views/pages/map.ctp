<div style="font-size: 1.5em; margin-left: 100px;">

<h3>Mapa serwisu</h3>

<ul>
<li><?php echo $this->Html->link('Logowanie', array('controller' => 'pages' , 'action' => 'home')); ?></li>
<li><?php echo $this->Html->link('Rejestracja ', array('controller' => 'pages' , 'action' => 'home')); ?></li>
</ul>

<ul>
<li><?php echo $this->Html->link('Strona główna', array('controller' => 'pages' , 'action' => 'home')); ?></li>
<li><?php echo $this->Html->link('Artykuły', array('controller' => 'articles' , 'action' => 'index')); ?></li>
<li><?php echo $this->Html->link('Forum', array('controller' => 'sections' , 'action' => 'index')); ?></li>

<li><?php echo $this->Html->link('Katalog zwierzaków ', array('controller' => 'pets' , 'action' => 'index')); ?></li>


<li><?php echo $this->Html->link('Gatunek', array('controller' => 'pets' , 'action' => 'index')); ?></li>
<li><?php echo $this->Html->link('Rasa', array('controller' => 'pets' , 'action' => 'index')); ?></li>
<li><?php echo $this->Html->link('Użytkownicy  ', array('controller' => 'owners' , 'action' => 'index')); ?></li>

<li><?php echo $this->Html->link('Mapa serwisu ', array('controller' => 'pages' , 'action' => 'map')); ?></li>

<?php //echo $this->Html->link('Kontakt ', array('controller' => 'pages' , 'action' => 'home')); ?>
<li><?php echo $this->Html->link('O stronie', array('controller' => 'pages' , 'action' => 'about')); ?></li>
<li><?php echo $this->Html->link('Twórca  ', array('controller' => 'pages' , 'action' => 'author')); ?></li>

</ul>


</div>
<?php /*
Zalogowani:

Wiadomości
Nowa wiadomość
Skrzynka odbiorcza
Wiadomości wysłane
Aktualności
Profil
Moi pupile 
Zarządzanie zdjęciami
Edycja pupila
Zmiana avatara
Dodaj pupila
Usuwanie pupila
Moje artykuły
Znajomi
Ulubieni
Ustawienia
Wyloguj się
*/ ?>
