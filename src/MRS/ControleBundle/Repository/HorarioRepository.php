<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Validator\Constraints\DateTime;

class HorarioRepository extends EntityRepository
{

    public function getDataByColum($colunm, $data)
    {
        $stmt =  $this->getEntityManager()
                      ->getConnection()
                      ->prepare("SELECT * FROM tb_horario WHERE {$colunm} = ?");

        $stmt->bindParam(1,$data,\PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    public function listarPontosByPeriod($dataInicial, $dataFinal)
    {
        $sql = "SELECT  hor_codigo
					,hor_dia_semana
					,hor_data
					,hor_entrada
					,hor_almoco_ida
					,hor_almoco_volta
					,hor_saida,

					#Calcula o total de horas do dia
					timediff(hor_saida,hor_entrada) as 'TotalDia',

					#Calcula o tempo de almo�o
					sec_to_time(time_to_sec(hor_almoco_volta) - time_to_sec(hor_almoco_ida)) as 'horaAlmoco',

					#Calcula o total de horas trabalhadas do dia
					sec_to_time(((time_to_sec(hor_almoco_ida) - time_to_sec(hor_entrada) ) +
					(time_to_sec(hor_saida) - time_to_sec(hor_almoco_volta) ))) as 'HorasTrabalhas'

					FROM tb_horario
						WHERE hor_data BETWEEN ? AND ?";


        return $this->getEntityManager()
                    ->createNativeQuery($sql, new ResultSetMapping())
                    ->setParameters(array('1' =>$dataInicial,'2' => $dataFinal))
                    ->getResult();


    }

    public function listarByPeriod($dataInicial, $dataFinal)
    {
        $sql = "SELECT  hor_codigo AS horCodigo
					,hor_dia_semana AS horDiaSemana
					,hor_data AS horData
					,hor_entrada AS horEntrada
					,hor_almoco_ida AS horAlmocoIda
					,hor_almoco_volta AS horAlmocoVolta
					,hor_saida AS horSaida
					,hor_justificativa AS horJustificativa
					,

					#Calcula o total de horas do dia
					timediff(hor_saida,hor_entrada) AS 'totalDia',

					#Calcula o tempo de almo�o
					sec_to_time(time_to_sec(hor_almoco_volta) - time_to_sec(hor_almoco_ida)) AS 'horaAlmoco',

					#Calcula o total de horas trabalhadas do dia
					sec_to_time(((time_to_sec(hor_almoco_ida) - time_to_sec(hor_entrada) ) +
					(time_to_sec(hor_saida) - time_to_sec(hor_almoco_volta) ))) AS 'horasTrabalhas'

					FROM tb_horario
					WHERE hor_data BETWEEN ? AND ?
					ORDER BY hor_data DESC";


        $stmt = $this->getEntityManager()
                     ->getConnection()
                     ->prepare($sql);

        $stmt->bindParam(1,$dataInicial,\PDO::PARAM_STR);
        $stmt->bindParam(2,$dataFinal,\PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


    }
/*

    /**
    * Query nativa do banco
	public function listAllHorario()
	{
		$stmt = $this->getEntityManager()
			->getConnection()
			->prepare('SELECT * FROM tb_horario');

			$stmt->execute();


			return $stmt->fetchAll();
	}
*/

/*
	/**
	 * @return array
	 * Used DQL

	public function listAllHorario()
	{
		return $this->getEntityManager()
			->createQuery(
				'SELECT h FROM MRSControleBundle:TbHorario h'
			)
			->getResult();
	}
*/

	/**
	 * @return array
	 * Used QueryBuilder

	public function listAllHorario()
	{
		return $this->getEntityManager()
			->createQueryBuilder()
			->select('h')
			->from('MRSControleBundle:TbHorario','h')
			->getQuery()
			->getResult();
	}
*/

	/**
	 * @return \Doctrine\ORM\createQuery
	 */
	public function listAllHorario()
	{
		return $this->getEntityManager()
			->createQuery('SELECT h FROM MRSControleBundle:TbHorario h ORDER BY h.horCodigo DESC')
			->getResult();

	}

    public function findByToday()
    {
        $toDay = new \DateTime('now');

            return $this->createQueryBuilder('h')
                ->where("h.horData = :today")
                ->setParameter('today',$toDay->format('Y-m-d'))
                ->getQuery()
                ->getOneOrNullResult();

    }

}