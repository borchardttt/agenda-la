<?php
session_start();
?>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agenda-la - Seu agendamento de barbearia fácil e rápido</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
		<div class="container mx-auto flex justify-between items-center">
			<div class="text-lg font-bold">
				<h1>Agenda-la</h1>
			</div>
			<nav class="space-x-4">
				<a href="#dashboard" class="hover:text-[#D3B18C]">Dashboard</a>
				<a href="#usuarios" class="hover:text-[#D3B18C]">Usuários</a>
				<a href="#relatorios" class="hover:text-[#D3B18C]">Relatórios</a>
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

	<section id="dashboard" class="bg-[#5C4033] text-[#F4E1C1] py-20">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl font-semibold mb-4">Dashboard de Administração</h2>
			<p class="text-lg mb-8">Gerencie suas operações e visualize informações essenciais em um só lugar.</p>
		</div>
	</section>

	<section id="usuarios" class="container mx-auto py-20 text-center">
		<h3 class="text-2xl font-semibold mb-6">Gerenciamento de Usuários</h3>
		<p class="text-lg text-[#5C4033] mb-5  max-w-3xl mx-auto">Visualize e administre todos os usuários cadastrados.
			Monitore o
			acesso e as atividades para garantir a melhor experiência.</p>
		<a href="/users" class="bg-[#C78E31] text-[#5C4033] py-3 px-6 rounded-full text-xl hover:bg-[#C78E31]">Ver
			Usuários</a>
	</section>

	<section id="relatorios" class="bg-[#D3B18C] py-20">
		<div class="container mx-auto text-center">
			<h3 class="text-2xl font-semibold mb-6">Relatórios de Atividades</h3>
			<p class="text-lg text-[#5C4033] max-w-3xl mb-5 mx-auto">Acompanhe as estatísticas de agendamentos, clientes e
				ganhos.
				Melhore suas decisões com base em dados reais.</p>
			<a href="#visualizarRelatorios"
				class="bg-[#C78E31] text-[#5C4033] py-3 px-6 mt-5 rounded-full text-xl hover:bg-[#C78E31]">Ver Relatórios</a>
		</div>
	</section>

	<footer class="bg-[#5C4033] text-[#F4E1C1] py-6 text-center">
		<p>&copy; 2024 Agenda-la. Todos os direitos reservados.</p>
	</footer>

</body>

</html>