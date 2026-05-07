<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

class ApiController extends AppController
{
    public function summary()
    {
        $connection = ConnectionManager::get('default');

        $total = $connection->execute(
            'SELECT COUNT(*) as total FROM patents'
        )->fetch('assoc');

        $types = $connection->execute(
            'SELECT patent_type, COUNT(*) as count
             FROM patents
             GROUP BY patent_type
             ORDER BY count DESC'
        )->fetchAll('assoc');

        $data = [
            'success' => true,
            'total_patents' => $total['total'],
            'patent_types' => $types,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($data, JSON_PRETTY_PRINT));
    }

    public function query()
    {
        $assignee = $this->request->getQuery('assignee');
        $type = $this->request->getQuery('patent_type');
        $year = $this->request->getQuery('year');

        $connection = ConnectionManager::get('default');

        $sql = 'SELECT * FROM patents WHERE 1=1';

        $params = [];

        if (!empty($assignee)) {
            $sql .= ' AND assignee ILIKE :assignee';
            $params['assignee'] = '%' . $assignee . '%';
        }

        if (!empty($type)) {
            $sql .= ' AND patent_type = :type';
            $params['type'] = $type;
        }

        if (!empty($year)) {
            $sql .= ' AND EXTRACT(YEAR FROM publication_date) = :year';
            $params['year'] = $year;
        }

        $sql .= ' ORDER BY publication_date DESC LIMIT 50';

        $result = $connection
            ->execute($sql, $params)
            ->fetchAll('assoc');

        $data = [
            'success' => true,
            'count' => count($result),
            'data' => $result,
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($data, JSON_PRETTY_PRINT));
    }
}