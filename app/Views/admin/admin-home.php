<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agenda-la - Seu agendamento de barbearia fácil e rápido</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<div class="flex min-h-screen">
		<aside id="sidebar" class="bg-[#5C4033] text-[#F4E1C1] w-16 p-4 transition-all duration-300">
			<div class="flex justify-end">
				<button onclick="toggleSidebar()" class="text-[#F4E1C1] focus:outline-none">
					<i class='bx bx-menu'></i>
				</button>
			</div>
			<nav class="mt-10 space-y-6">
				<a href="#dashboard"
					class="sidebar-link flex items-center space-x-4 p-2 rounded hover:bg-[#D3B18C] hover:text-[#5C4033]"
					onclick="setActiveSection(event, 'dashboard')">
					<i class='bx bxs-dashboard'></i>
					<span class="sidebar-link-text hidden">Dashboard</span>
				</a>
				<a href="#usuarios"
					class="sidebar-link flex items-center space-x-4 p-2 rounded hover:bg-[#D3B18C] hover:text-[#5C4033]"
					onclick="setActiveSection(event, 'usuarios')">
					<i class='bx bx-user-pin'></i>
					<span class="sidebar-link-text hidden">Usuários</span>
				</a>
				<a href="#relatorios"
					class="sidebar-link flex items-center space-x-4 p-2 rounded hover:bg-[#D3B18C] hover:text-[#5C4033]"
					onclick="setActiveSection(event, 'relatorios')">
					<i class='bx bx-book-content'></i>
					<span class="sidebar-link-text hidden">Relatórios</span>
				</a>
			</nav>
		</aside>

		<main class="flex-1">
			<header class="bg-[#5C4033] text-[#F4E1C1] px-8 py-4 shadow-lg flex items-center justify-between">
				<div class="text-2xl font-bold">Agenda-la</div>
				<nav class="space-x-6">
					<a href="#dashboard" class="hover:text-[#D3B18C]">Dashboard</a>
					<a href="#usuarios" class="hover:text-[#D3B18C]">Usuários</a>
					<a href="#relatorios" class="hover:text-[#D3B18C]">Relatórios</a>
					<a href="/create-service" class="hover:text-[#D3B18C]">Serviços</a>
					<?php if (isset($_SESSION['user'])): ?>
						<span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</span>
						<a href="/logout" class="hover:text-[#D3B18C]">Logout</a>
					<?php else: ?>
						<a href="/login" class="hover:text-[#D3B18C]">Acessar</a>
					<?php endif; ?>
				</nav>
			</header>

			<section id="dashboard" class="p-10">
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
					<div class="bg-white shadow-md rounded-lg p-6">
						<h3 class="text-xl font-bold mb-2 text-[#5C4033]">Visão Geral</h3>
						<p class="text-sm text-gray-600">Resumo rápido de informações importantes do sistema.</p>
					</div>
					<div class="bg-white shadow-md rounded-lg p-6">
						<h3 class="text-xl font-bold mb-2 text-[#5C4033]">Estatísticas</h3>
						<p class="text-sm text-gray-600">Acompanhe os números do dia a dia.</p>
					</div>
					<div class="bg-white shadow-md rounded-lg p-6">
						<h3 class="text-xl font-bold mb-2 text-[#5C4033]">Alertas</h3>
						<p class="text-sm text-gray-600">Fique por dentro dos alertas mais recentes.</p>
					</div>
				</div>
			</section>

			<section id="usuarios" class="p-10">
				<h2 class="text-2xl font-bold text-[#5C4033] mb-4">Gerenciamento de Usuários</h2>
				<div class="bg-white shadow-md rounded-lg p-6">
					<p class="text-sm text-gray-600">Visualize e administre todos os usuários cadastrados.</p>
					<a href="/users"
						class="bg-[#C78E31] text-[#5C4033] py-2 px-4 rounded mt-4 inline-block hover:bg-[#D3B18C]">Ver Usuários</a>
				</div>
			</section>

			<section id="relatorios" class="p-10">
				<h2 class="text-2xl font-bold text-[#5C4033] mb-4">Relatórios</h2>
				<div class="grid md:grid-cols-2 gap-6">
					<div class="bg-white shadow-md rounded-lg p-6">
						<h3 class="text-xl font-bold text-[#5C4033] mb-2">Agendamentos</h3>
						<p class="text-sm text-gray-600">Detalhes dos agendamentos realizados.</p>
					</div>
					<div class="bg-white shadow-md rounded-lg p-6">
						<h3 class="text-xl font-bold text-[#5C4033] mb-2">Ganhos</h3>
						<p class="text-sm text-gray-600">Resumo financeiro da barbearia.</p>
					</div>
				</div>
			</section>
		</main>
	</div>
	<script>
		function toggleSidebar() {
			const sidebar = document.getElementById('sidebar');
			const links = document.querySelectorAll('.sidebar-link-text');
			sidebar.classList.toggle('w-64');
			sidebar.classList.toggle('w-16');
			links.forEach(link => link.classList.toggle('hidden'));
		}

		function setActiveSection(event, sectionId) {
			document.querySelectorAll('.sidebar-link').forEach(link => {
				link.classList.remove('bg-[#D3B18C]', 'text-[#5C4033]');
			});

			event.currentTarget.classList.add('bg-[#D3B18C]', 'text-[#5C4033]');

			document.getElementById(sectionId).scrollIntoView({
				behavior: 'smooth'
			});
		}
	</script>
</body>

</html>