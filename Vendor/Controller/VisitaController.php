<?php
namespace Vendor\Controller;

use Vendor\Model\{Postagem,Usuario};
use Vendor\DAO\{PostagemDAO,usuarioDAO};
use Vendor\Model\{Noticia,Login};
use Vendor\Factory\ConnectionFactory;
use Vendor\Lib\View;

class VisitaController{
	private $postagemDao;
	private $usuarioDao;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->postagemDao = new PostagemDAO($con);
		$this->usuarioDao = new UsuarioDAO($con);
	}


public function visita(){
		$view = new View('index','Visita');
			$usuario = $this->usuarioDao->buscaPorId($_GET["usuarioId"]);
			$usuarioLogado = Login::getUsuario();
			$postagens = $this->postagemDao->lista($usuario->getId());
			$postsPorSemana = $this->postagemDao->postsPorSemana($usuario->getId());
			
			$view->viewBag('postagens',$postagens);
			$view->viewBag('postsPorSemana',$postsPorSemana);
			$view->viewBag('usuario',$usuario);
			$view->viewBag('usuarioLogado',$usuarioLogado);

			return $view;
	}
}