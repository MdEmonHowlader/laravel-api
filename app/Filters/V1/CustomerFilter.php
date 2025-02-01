<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter {
    protected $safeParams = [
   'name'=>['eq'],
   'type'=>['eq'],
    'email'=>['eq'],
    'address'=>['eq'],
    'city'=>['eq'],
    'state'=>['eq'],
    'zip'=>['eq'],
    'postal_code'=>['eq', 'lt', 'gt'],

    ];
    protected $columnMap=[
        'postalCode'=>'postal_code',
    
    ];
    protected $operatorMap=[
        'eq'=>'=',
        'lt'=>'<',
        'gt'=>'>',
        'lte'=>'<=',
        'gte'=>'>=',
    
    ];
    public function transform(Request $request)
    {
        $eolquery=[];
        foreach($this->safeParams as $parm=>$operators){
            $query=$request->query($parm);
            if(!isset($query)){
                continue;
            }
            $column=$this->columnMap[$parm]??$parm;
            foreach($operators as $operator){
                if(isset($query[$operator])){
                   $eolquery[$parm]=$column.$this->columnMap[$operator].$query[$operator];
                }
            }
        }  
        return $eolquery;      
    }
}