<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(config('app.name', 'Laravel')); ?> | DNK TAX SYSTEM</title>

	<!-- Scripts -->
	<script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
	<script src="<?php echo e(asset('js/javascript.js')); ?>" defer></script>

	<!-- Fonts -->
	<!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->

	<!-- Styles -->
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/default-admin.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
	<?php echo $__env->yieldContent('css'); ?>

</head>
<body>

	<?php echo $__env->yieldContent('content'); ?>

</body>
</html>
