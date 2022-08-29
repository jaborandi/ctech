<footer class="footer border-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright">Todos os direitos reservados | &copy; {{ config("app.name") }} - {{ date('Y') }}</div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					<a href="{{ url('info/about') }}">Sobre nós</a> | 
					<a href="{{ url('info/faq') }}">Ajuda e FAQ</a> |
					<a href="{{ url('info/contact') }}">Contate-Nos</a>  |
					<a href="{{ url('info/privacypolicy') }}">Política de Privacidade</a> |
					<a href="{{ url('info/termsandconditions') }}">Termos e Condições</a>
				</div>
			</div>
			
		</div>
	</div>
</footer>