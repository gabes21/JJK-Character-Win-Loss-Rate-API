<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CharacterQuery {
    protected $safeParms = [
        'win' => ['eq', 'gt', 'lt'],
        'loss' => ['eq', 'gt', 'lt'],
        'alignment' => ['eq']
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)) {
                continue;
            }

            $column = $parm;

            foreach($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        
        return $eloQuery;
    }
}