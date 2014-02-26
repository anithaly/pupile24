<ul class="foot-nav">
  <?php /* ?><li><?php// echo $this->Html->link('Pomoc', array ('controller' => 'pages', 'action' => 'help', 'admin' => false)); ?></li> */ ?>
  <?php /* ?><li><?php //echo $this->Html->link('Regulamin', array ('controller' => 'pages', 'action' => 'rules', 'admin' => false)); ?></li> */ ?>
  <?php /* <li><?php //echo $this->Html->link('Kontakt', array ('controller' => 'pages', 'action' => 'contact', 'admin' => false)); ?></li> */ ?>
  <li><?php echo $this->Html->link('O stronie', array ('controller' => 'pages', 'action' => 'about', 'admin' => false)); ?></li>
  <li><?php echo $this->Html->link('Twórca', array ('controller' => 'pages', 'action' => 'author', 'admin' => false)); ?></li>
</ul>

<p class="info"><span id="validation">Walidacja:  <a href="http://validator.w3.org/check?uri=referer">xhtml 1.0 strict</a>, <a href="http://jigsaw.w3.org/css-validator/check/referer">css 2.1</a></span>
<span class="author">Autor: <a href="mailto:anithaly@gmail.com">Natalia Stanko</a> &copy;&nbsp;2011</span>
<span class="engine">Framework: <?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt'=> __('CakePHP', true), 'border' => '0')),'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)); ?></span>
</p>
