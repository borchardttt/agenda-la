<!-- /app/Views/home.php -->
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agenda-la - Seu agendamento de barbearia fácil e rápido</title>
	<script src="https://cdn.tailwindcss.com"></script> <!-- Carregando Tailwind CSS -->
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

	<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
		<div class="container mx-auto flex justify-between items-center">
			<div class="text-lg font-bold">
				<h1>Agenda-la</h1>
			</div>
			<nav class="space-x-4">
				<a href="#sobre" class="hover:text-[#D3B18C]">Sobre</a>
				<a href="#beneficios" class="hover:text-[#D3B18C]">Benefícios</a>
				<a href="#contato" class="hover:text-[#D3B18C]">Contato</a>
				<a href="/services" class="hover:text-[#D3B18C]">Serviços</a>
				<a href="/login" class="hover:text-[#D3B18C]">Acessar</a>
			</nav>
		</div>
	</header>

	<section class="bg-[#5C4033] text-[#F4E1C1] py-20">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl font-semibold mb-4">Simplifique seu agendamento de cortes de cabelo!</h2>
			<p class="text-lg mb-8">Conecte-se facilmente com seus clientes e organize os horários de forma eficiente.</p>
			<a href="#agendar" class="bg-[#C78E31] text-[#5C4033] py-3 px-6 rounded-full text-xl hover:bg-[#C78E31]">Agendar
				Agora</a>
		</div>
	</section>

	<section id="sobre" class="container mx-auto py-20 text-center">
		<h3 class="text-2xl font-semibold mb-6">Sobre o Sistema</h3>
		<p class="text-lg text-[#5C4033] max-w-3xl mx-auto">O Agenda-la foi criado para facilitar a vida dos barbeiros e
			seus clientes. Com o nosso sistema de agendamento online, você pode organizar seu dia de trabalho sem complicação
			e seus clientes podem marcar horários de maneira prática, sem precisar ligar ou ir até a loja.</p>
	</section>

	<section id="beneficios" class="bg-[#D3B18C] py-20">
		<div class="container mx-auto text-center">
			<h3 class="text-2xl font-semibold mb-6">Benefícios do Sistema</h3>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
				<div class="bg-white p-6 rounded-lg shadow-md">
					<h4 class="text-xl font-semibold mb-4">Organização</h4>
					<p class="text-gray-700">Controle total sobre os agendamentos e os horários de atendimento. Evite falhas e
						overbooking.</p>
				</div>
				<div class="bg-white p-6 rounded-lg shadow-md">
					<h4 class="text-xl font-semibold mb-4">Praticidade</h4>
					<p class="text-gray-700">Seus clientes podem agendar o corte de cabelo diretamente do seu celular, sem
						precisar ligar ou ir até a loja.</p>
				</div>
				<div class="bg-white p-6 rounded-lg shadow-md">
					<h4 class="text-xl font-semibold mb-4">Controle Financeiro</h4>
					<p class="text-gray-700">Tenha visibilidade sobre os lucros diários, sem precisar de registros manuais ou
						planilhas.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="contato" class="container mx-auto py-20 text-center">
		<h3 class="text-2xl font-semibold mb-6">Entre em Contato</h3>
		<p class="text-lg text-[#5C4033] mb-6">Dúvidas ou quer saber mais sobre o Agenda-la? Entre em contato conosco!</p>
		<a href="mailto:contato@agendala.com"
			class="bg-[#5C4033] text-[#F4E1C1] py-3 px-6 rounded-full text-xl hover:bg-[#5C4033]">Enviar E-mail</a>
	</section>

	<footer class="bg-[#5C4033] text-[#F4E1C1] py-6 text-center">
		<p>&copy; 2024 Agenda-la. Todos os direitos reservados.</p>
	</footer>

</body>

</html>