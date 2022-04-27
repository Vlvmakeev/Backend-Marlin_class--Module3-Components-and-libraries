<?php $this->layout('layout', ['email' => 'example@example.com']) ?>

<h1>User Profile</h1>
<p>Hello, <?=$this->e($contact)?></p>