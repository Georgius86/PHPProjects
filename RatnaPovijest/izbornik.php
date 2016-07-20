<div class="row">
	<div class="large 12 columns">
		
		<nav class="top-bar" data-topbar="" role="navigation">
      <ul class="title-area">
        <li class="name">
          <?php if(isset($_SESSION['operater'])): ?>
          	<h1><a href="<?php echo $putanjaPovijest; ?>privatno/pregledStoljeca.php">&#x2302;</a></h1>
          	<?php endif; ?>
          <?php if(!isset($_SESSION['operater'])): ?>
          	<h1><a href="<?php echo $putanjaPovijest; ?>index.php">&#x2302;</a></h1>
          	<?php endif; ?>
        </li>
        <li class="toggle-topbar menu-icon"><a href=""><span>Menu</span></a></li>
      </ul>

      
    <section class="top-bar-section">

        <!-- Lijevo pojavi se na malom uređaju (zamjenjuje lijevo prvi i drugi)-->
      
        <!--<ul class="left hide-for-large-up">
          <li class="active"><a href="#">Srednji vijek</a></li>
          <li class="active"><a href="#">Srednji vijek</a></li>
          <li class="has-dropdown not-click">
            <a href="#">Ratovi</a>
            <ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Nazad</a></h5></li><li class="parent-link hide-for-large-up"><a class="parent-link js-generated" href="#">Right Dropdown</a></li>
              <li class="active"><a href="#">Srednji vijek</a></li>
              <li class="active"><a href="#">Active link in dropdown</a></li>
            </ul>
          </li>
        </ul> -->

        <!-- Lijevo prvi -->
        <ul class="left show-for-large-up" id="boja">
        	<li class="divider"></li>
        	<?php if(!isset($_SESSION['operater'])): ?>
          <li>
          	<a href="<?php echo $putanjaPovijest; ?>srednjivijek.php">Srednji vijek</a>          	        	
          </li>
          <li>
          	<a href="<?php echo $putanjaPovijest; ?>ustroj.php">Ustroj srednjovjekovne države i feudalizam</a>          	        	
          </li>
          <li>
          	<a href="<?php echo $putanjaPovijest; ?>ratnapovijest.php">Ratna Povijest</a>          	        	
          </li>
   <!--       <li>
          	<a href="<?php echo $putanjaPovijest; ?>vladariplemstvo.php">Vladari i plemstvo</a>          	        	
      </li> -->
          <?php endif; ?>
        </ul>
        <!-- Lijevo drugi -->
         <ul class="left show-for-large-up" id="boja">
         	<?php if(isset($_SESSION['operater'])): ?>
         		<li class="divider"></li>					
					<li>
						<a href="<?php echo $putanjaPovijest; ?>privatno/operateri/index.php">Operateri</a>
					</li>
					<li>
						<a href="<?php echo $putanjaPovijest; ?>privatno/titule/index.php">Titule</a>						
					</li>
					<li>						
						<a href="<?php echo $putanjaPovijest; ?>privatno/osobe/index.php">Osobe</a>
					</li>
					<li>
						<a href="<?php echo $putanjaPovijest; ?>privatno/zemlje/index.php">Srednjovjekovne zemlje</a>
					</li>
					
					<li>						
						<a href="<?php echo $putanjaPovijest; ?>privatno/ratovi/index.php">Ratovi</a>
					</li>
					
					<li>						
						<a href="<?php echo $putanjaPovijest; ?>privatno/ratovi/strane/index.php">Traži i napravi sukobljene strane u ratu</a>
					</li>
					
					<?php endif; ?>
					<li class="divider"></li>
          <li><a href="<?php echo $putanjaPovijest; ?>kontakt.php">Kontakt</a></li>
          
        </ul>
        
        
        <!-- Desno login -->
        <ul class="right show-for-large-up" id="boja">
          <li>
        	<?php 
          	if (!isset($_SESSION['operater'])): 
			?>
          	<a href="<?php echo $putanjaPovijest; ?>login.php">Admin</a>
          	<?php
			endif;
          	if(isset($_SESSION["operater"])):
			?>
			<a href="<?php echo $putanjaPovijest; ?>logout.php">Logout</a>
			<?php 
			endif;
			?>
          </li>
        </ul>
        
        
        
      </section></nav>
	</div>
	
</div>