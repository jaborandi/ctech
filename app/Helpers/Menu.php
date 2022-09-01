
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Início", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'atividades',
			'label' => "Atividades", 
			'icon' => '<i class="material-icons ">mode_edit</i>'
		],
		
		[
			'path' => 'agenda_fablab',
			'label' => "Agenda Fablab", 
			'icon' => '<i class="material-icons ">event</i>'
		],
		
		[
			'path' => 'agenda_cinema',
			'label' => "Agenda Cinema", 
			'icon' => '<i class="material-icons ">event_note</i>'
		],
		
		[
			'path' => 'compras',
			'label' => "Compras", 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		],
		
		[
			'path' => 'tarefas',
			'label' => "Tarefas", 
			'icon' => '<i class="material-icons ">assignment</i>','submenu' => [
		[
			'path' => 'tarefas',
			'label' => "Minhas Tarefas", 
			'icon' => ''
		],
		
		[
			'path' => 'tarefas/atribuidas',
			'label' => "Tarefas Atribuidas", 
			'icon' => ''
		]
	]
		]
	] ;
	}
	
		
	public static function confirmacao(){
		return [
		[
			'value' => '#6c757d', 
			'label' => "Aguardando", 
		],
		[
			'value' => '#28a745', 
			'label' => "Confirmada", 
		],
		[
			'value' => '#dc3545', 
			'label' => "Rejeitada", 
		],] ;
	}
	
	public static function disciplina(){
		return [
		[
			'value' => 'ARTES', 
			'label' => "Artes", 
		],
		[
			'value' => 'CIÊNCIAS', 
			'label' => "Ciências", 
		],
		[
			'value' => 'EDUCAÇÃO FÍSICA', 
			'label' => "Educação Física", 
		],
		[
			'value' => 'GEOGRAFIA', 
			'label' => "Geografia", 
		],
		[
			'value' => 'HISTÓRIA', 
			'label' => "História", 
		],
		[
			'value' => 'LÍNGUA PORTUGUESA', 
			'label' => "Língua Portuguesa", 
		],
		[
			'value' => 'MATEMÁTICA', 
			'label' => "Matemática", 
		],
		[
			'value' => 'INGLÊS', 
			'label' => "Inglês", 
		],
		[
			'value' => 'INFANTIL', 
			'label' => "Infantil", 
		],] ;
	}
	
	public static function status(){
		return [
		[
			'value' => 'AGUARDANDO ANÁLISE', 
			'label' => "Aguardando Análise", 
		],
		[
			'value' => 'COMPRA APROVADA', 
			'label' => "Compra Aprovada", 
		],
		[
			'value' => 'ORDEM DE COMPRA EMITIDA', 
			'label' => "Ordem de compra emitida", 
		],
		[
			'value' => 'PRESTANDO CONTAS', 
			'label' => "Prestando Contas", 
		],
		[
			'value' => 'FINALIZADO', 
			'label' => "Finalizado", 
		],] ;
	}
	
	public static function status2(){
		return [
		[
			'value' => 'AGUARDANDO', 
			'label' => "AGUARDANDO", 
		],
		[
			'value' => 'EM PROGRESSO', 
			'label' => "EM PROGRESSO", 
		],
		[
			'value' => 'CONCLUÍDA', 
			'label' => "CONCLUÍDA", 
		],] ;
	}
	
	public static function atividades_disciplina(){
		return [
		[
			'value' => 'ARTES', 
			'label' => "Artes", 
		],
		[
			'value' => 'CIÊNCIAS', 
			'label' => "Ciências", 
		],
		[
			'value' => 'EDUCAÇÃO FÍSICA', 
			'label' => "Educação Física", 
		],
		[
			'value' => 'GEOGRAFIA', 
			'label' => "Geografia", 
		],
		[
			'value' => 'HISTÓRIA', 
			'label' => "História", 
		],
		[
			'value' => 'LÍNGUA PORTUGUESA', 
			'label' => "Língua Portuguesa", 
		],
		[
			'value' => 'MATEMÁTICA', 
			'label' => "Matemática", 
		],
		[
			'value' => 'INFANTIL', 
			'label' => "Infantil", 
		],] ;
	}
	
	}
