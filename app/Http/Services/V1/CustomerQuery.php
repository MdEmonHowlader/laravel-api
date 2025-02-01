<?php
namespace App\Http\Services\V1;
use Illuminate\Http\Request;
class CustomerQuery{
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