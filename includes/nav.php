<?php include_once ('includes/functions.php');
$current_page = basename($_SERVER['PHP_SELF']); // gets current file name 
?>
<nav>
  <ul>
    <?php if (isGranted()): ?>
		<li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a></li>
		<li><a href="catalog.php" class="<?= $current_page == 'catalog.php' ? 'active' : '' ?>">Products</a></li>
		<li><a href="cart.php" class="<?= $current_page == 'cart.php' ? 'active' : '' ?>">Cart</a></li>
		<li><a href="logout.php" class="<?= $current_page == 'logout.php' ? 'active' : '' ?>">Log out</a></li>
    <?php else: ?>
		<li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Log In</a></li>
		<li><a href="create-account.php" class="<?= $current_page == 'create-account.php' ? 'active' : '' ?>">Create Account</a></li>
		<li><a href="catalog.php" class="<?= $current_page == 'catalog.php' ? 'active' : '' ?>">Products</a></li>
    <?php endif; ?>
  </ul>
</nav>