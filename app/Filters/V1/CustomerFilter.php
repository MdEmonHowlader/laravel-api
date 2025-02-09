<?php
namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter {
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'zip' => ['eq'],
        'postalCode' => ['eq', 'lt', 'gt'],
    ];

    protected $columnMap = [
        'postalCode' => 'zip',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
    ];

    // public function transform(Request $request)
    // {
    //     $eolquery = [];
    //     foreach ($this->safeParams as $param => $operators) {
    //         $query = $request->query($param);
    //         if (!isset($query)) {
    //             continue;
    //         }
    //         $column = $this->columnMap[$param] ?? $param;
    //         foreach ($operators as $operator) {
    //             if (isset($query[$operator])) {
    //                 $eolquery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
    //             }
    //         }
    //     }
    //     return $eolquery;
    // }
}