<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usuários - Agenda-la</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
		<div class="container mx-auto flex justify-between items-center">
			<div class="text-lg font-bold">
				<h1>Agenda-la - Usuários</h1>
			</div>
			<nav class="space-x-4">
				<a href="/" class="hover:text-[#D3B18C]">Home</a>
				<a href="/about" class="hover:text-[#D3B18C]">Sobre</a>
				<a href="/services" class="hover:text-[#D3B18C]">Serviços</a>
				<?php if (isset($_SESSION['user'])): ?>
					<span class="font-semibold">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</span>
					<a href="/logout" class="hover:text-[#D3B18C]">Logout</a>
				<?php else: ?>
					<a href="/login" class="hover:text-[#D3B18C]">Acessar</a>
				<?php endif; ?>
			</nav>
		</div>
	</header>

	<section class="container mx-auto py-20 text-center">
		<h2 class="text-3xl font-semibold mb-6">Usuários do Sistema</h2>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php foreach ($users as $user): ?>
				<div class="bg-white p-6 rounded-lg shadow-md">
					<h4 class="text-xl font-semibold mb-4"><?php echo $user['name']; ?></h4>
					<p class="text-gray-700 mt-2">Email: <?php echo htmlspecialchars($user['email']); ?></p>
					<p class="text-gray-700">Tipo de usuário: <?php echo htmlspecialchars($user['type']); ?></p>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

</body>

</html>