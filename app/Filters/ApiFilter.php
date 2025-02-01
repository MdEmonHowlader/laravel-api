<?php
namespace App\Filters;
use Illuminate\Http\Request;
class  ApiFilter {
    protected $safeParams = [];
    protected $columnMap=[];
    protected $operatorMap=[];
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