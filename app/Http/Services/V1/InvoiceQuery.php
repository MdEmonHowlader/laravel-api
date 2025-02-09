<?php
namespace App\Http\Services\V1;
use Illuminate\Http\Request;
class InvoiceQuery{
    protected $safeParams = [
   'customer_id'=>['eq'],
   'amount'=>['eq', 'lt', 'gt'],
   'status'=>['eq'],
   'billed_date'=>['eq', 'lt', 'gt'],
   'paid_date'=>['eq', 'lt', 'gt'],
  
    ];
    protected $columnMap=[
        'billedDate'=>'billed_date',
        'paidDate'=>'paid_date',
    
    
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