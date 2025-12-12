<?php

namespace App\Controllers;

use App\Controller;
use App\Database;

class DashboardController extends Controller {
    
    public function index(): void {
        // Obtém estatísticas para o dashboard
        $stats = [
            'total_mercadorias' => (int)Database::fetchColumn("SELECT COUNT(*) FROM mercadorias"),
            'qtd_total_estoque' => (int)Database::fetchColumn("SELECT COALESCE(SUM(quantidade_estoque), 0) FROM mercadorias"),
            'total_clientes' => (int)Database::fetchColumn("SELECT COUNT(*) FROM clientes"),
            'despachos_pendentes' => (int)Database::fetchColumn("SELECT COUNT(*) FROM despachos WHERE status != 'Entregue'"),
            'pedidos_mes' => (int)Database::fetchColumn("SELECT COUNT(*) FROM pedidos_venda WHERE MONTH(created_at) = MONTH(NOW())"),
            'oportunidades_abertas' => (int)Database::fetchColumn("SELECT COUNT(*) FROM oportunidades WHERE status = 'Aberta'"),
        ];
        
        $this->render('_dashboard', ['stats' => $stats]);
    }
}
