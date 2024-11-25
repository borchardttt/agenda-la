<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Serviços - Agenda-la</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
		<div class="container mx-auto flex justify-between items-center">
			<div class="text-lg font-bold">
				<h1>Agenda-la - Serviços</h1>
			</div>
			<nav class="space-x-4">
				<a href="/" class="hover:text-[#D3B18C]">Home</a>
				<a href="/about" class="hover:text-[#D3B18C]">Sobre</a>
				<a href="/services" class="hover:text-[#D3B18C]">Serviços</a>
			</nav>
		</div>
	</header>

	<section class="container mx-auto py-20 text-center">
		<h2 class="text-3xl font-semibold mb-6">Nossos Serviços</h2>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php foreach ($services as $service): ?>
				<div class="bg-white p-6 rounded-lg shadow-md">
					<h4 class="text-xl font-semibold mb-4"><?php echo htmlspecialchars($service['name']); ?></h4>
					<p class="text-gray-700 mt-2">Preço: R$ <?php echo number_format($service['price'], 2, ',', '.'); ?></p>
					<p class="text-gray-700"><?php echo htmlspecialchars($service['time']); ?> minutos</p>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

</body>

</html>