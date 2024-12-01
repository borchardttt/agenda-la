<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard - Agenda-la</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
		<div class="container mx-auto flex justify-between items-center">
			<div class="text-lg font-bold">
				<h1>Dashboard do Barbeiro</h1>
			</div>
			<nav class="space-x-4">
				<?php if (isset($_SESSION['user'])): ?>
					<span class="font-semibold">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</span>
					<a href="/logout" class="hover:text-[#D3B18C]">Logout</a>
				<?php else: ?>
					<a href="/login" class="hover:text-[#D3B18C]">Acessar</a>
				<?php endif; ?>
			</nav>
		</div>
	</header>

	<main class="container mx-auto py-10">
		<section class="bg-white shadow-md rounded-lg p-6 mb-10">
			<h2 class="text-2xl font-semibold mb-4">Serviços do Dia</h2>
			<div id="chart-servicos"></div>
		</section>

		<section class="bg-white shadow-md rounded-lg p-6 mb-10">
			<h2 class="text-2xl font-semibold mb-4">Total em R$ do Dia</h2>
			<div id="chart-receita"></div>
		</section>
	</main>

	<footer class="bg-[#5C4033] text-[#F4E1C1] py-6 text-center">
		<p>&copy; 2024 Agenda-la. Todos os direitos reservados.</p>
	</footer>

	<script>
		const servicosData = [2, 3, 1, 2, 1];
		const receitaData = [150, 200, 175, 100, 300];

		const optionsServicos = {
			chart: {
				type: 'bar',
				height: 350,
				toolbar: {
					show: false
				}
			},
			series: [{
				name: 'Serviços',
				data: servicosData
			}],
			xaxis: {
				categories: ['09h', '10h', '11h', '12h', '13h']
			},
			title: {
				text: 'Número de Serviços Realizados',
				align: 'center'
			},
			colors: ['#D3B18C'],
			dataLabels: {
				enabled: true
			}
		};

		const chartServicos = new ApexCharts(document.querySelector("#chart-servicos"), optionsServicos);
		chartServicos.render();

		const optionsReceita = {
			chart: {
				type: 'line',
				height: 350,
				toolbar: {
					show: false
				}
			},
			series: [{
				name: 'Receita (R$)',
				data: receitaData
			}],
			xaxis: {
				categories: ['09h', '10h', '11h', '12h', '13h']
			},
			title: {
				text: 'Receita do Dia',
				align: 'center'
			},
			colors: ['#5C4033'],
			dataLabels: {
				enabled: true
			},
			tooltip: {
				shared: true,
				intersect: false,
			},
			stroke: {
				curve: 'smooth'
			}
		};

		const chartReceita = new ApexCharts(document.querySelector("#chart-receita"), optionsReceita);
		chartReceita.render();
	</script>

</body>

</html>