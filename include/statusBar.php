<?php
class StatusBar
{   //class representing a Vehicle on the server
    //private const
    public
        $money,   //float
        $tokens,  //uint
        $prestige,  //uint
        $markers; //uint
    
    public function __construct($money, $tokens, $prestige, $markers){  //$upgrades, $repairs
        $this->money = $money;
        $this->tokens = $tokens;
        $this->prestige = $prestige;
        $this->markers = $markers;
    }
    public static function fromArray($array){
        return new StatBar(
            floatval($array['_money']),
            intval($array['_tokens']),
            intval($array['_prestige']),
            intval($array['_markers'])
        );
    }
    public function toJSON(){
        //returns json representation of the vehicle data, for transfer over internet
        return '{"money":' . strval($this->money) . ', "tokens":' . strval($this->tokens) . ', "prestige":' . strval($this->prestige) . ', "markers":' . strval($this->markers) . '}';
        /*return json_encode(array(
                'money'=>$this->money,
                'tokens'=>$this->tokens,
                'prestige'=>$this->prestige,
                'markers'=>$this->markers
                )
            );*/
    }
    //update(){
        //sql query user's stats
    //}
    public function html(){?>
<!--div id ='statBar'>
    <label>User: <php echo $this->uname;?></label>
    <label id='cash'>Money: <php echo $this->money;?></label>
    <label id='tokens'>Tokens: <php echo $this->tokens;?></label>
    <label id='prest'>Prestige: <php echo $this->prest;?></label>
    <label id='markers'>Mile Markers: <php echo $this->markers;?></label>
</div-->
<?php
    }
}
?>