<?php

namespace Model;

use Data\Database;

class UsuarioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Usuario object
     */
    private $object;

    public function setUp()
    {
        $this->object = new Usuario();
    }

    public function testGetByEmailAndPasswordWithValidPassword()
    {
        /** @var Database|\PHPUnit_Framework_MockObject_MockObject $conn */
        $conn = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->setMethods(['recuperarTudo', 'salvar'])
            ->getMock();

        $conn->expects($this->any())
            ->method('recuperarTudo')
            ->willReturn(
                [
                    [
                        "CodUsu"    => 2,
                        "NomUsu"    => "Igor Brites",
                        "DatNasUsu" => "1987-03-03",
                        "SenUsu"    => "e10adc3949ba59abbe56e057f20f883e",
                        "EmaUsu"    => "igor.brites.87@gmail.com",
                        "AvaUsu"    => null
                    ]
                ]
            );


        $this->object->setConexao($conn);

        $received = $this->object->getPeloEmailESenha('usuario', 'senha-valida');
        $this->assertTrue($received instanceof Usuario);
    }

    public function testGetByEmailAndPasswordWithInvalidPassword()
    {
        /** @var Database|\PHPUnit_Framework_MockObject_MockObject $conn */
        $conn = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->setMethods(['recuperarTudo', 'salvar'])
            ->getMock();

        $conn->expects($this->once())
            ->method('recuperarTudo')
            ->willReturn([]);


        $this->object->setConexao($conn);

        $this->setExpectedException(\Exception::class);
        $this->object->getPeloEmailESenha('usuario', 'senha-invalida');
    }

    public function testVerificaSeEmailInvalidoExiste()
    {
        /** @var Database|\PHPUnit_Framework_MockObject_MockObject $conn */
        $conn = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->setMethods(['recuperarTudo'])
            ->getMock();

        $conn->expects($this->once())
            ->method('recuperarTudo')
            ->willReturn([]);


        $this->object->setConexao($conn);

        $this->setExpectedException(\Exception::class);
        $this->object->getPeloEmailESenha('usuario', 'senha-invalida');
    }
}
