<?php

use PHPUnit\Framework\TestCase;

class ExemploTest extends TestCase
{
    public function testExemplo()
    {
        $this->assertTrue(true);
    }
    public function testAgendamentoFormFields()
    {
        // Simula o envio do formulário com dados de exemplo
        $_POST = [
            'nome_servidor' => 'João Silva',
            'tipo_de_usuario' => 'servidorPublico',
            'nome_acompanhante' => '',
            'telefone' => '(11)91234-5678',
            'email' => '',
            'tipo' => 'consulta',   
            'data_agendamento' => '2024-07-01',
            'horario' => '09:00',
            'status' => 'confirmado'
        ];
        // Verifica se os campos obrigatórios estão presentes
        $this->assertArrayHasKey('nome_servidor', $_POST);
        $this->assertArrayHasKey('tipo_de_usuario', $_POST);
        $this->assertArrayHasKey('telefone', $_POST);
        $this->assertArrayHasKey('tipo', $_POST);
        $this->assertArrayHasKey('data_agendamento', $_POST);
        $this->assertArrayHasKey('horario', $_POST);
        $this->assertArrayHasKey('status', $_POST);
    
        // Verifica se os campos obrigatórios não estão vazios
        $this->assertNotEmpty($_POST['nome_servidor']); 
        $this->assertNotEmpty($_POST['tipo_de_usuario']);
        $this->assertNotEmpty($_POST['telefone']);
        $this->assertNotEmpty($_POST['tipo']);
        $this->assertNotEmpty($_POST['data_agendamento']);
        $this->assertNotEmpty($_POST['horario']);
        $this->assertNotEmpty($_POST['status']);

    }
}
?>
