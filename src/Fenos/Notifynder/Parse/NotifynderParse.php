<?php use Fenos\Notifynder\Parse\NotifynderParse;

class NotifynderParser extends NotifynderParse
{

	/**
     * Replace relations values
     *
     * @param $value_user
     * @param $relation
     * @param $body
     * @param $item
     * @return mixed
     */
    public function insertValuesRelation($value_user, $relation, $body, $item)
    {
        foreach($value_user as $value)
        {
            if($relation!='extra'){
                $body = preg_replace(
                    "{{" . $relation . "." . $value . "}}",
                    $item[$relation][$value],
                    $body
                );  
            }
            
        }

        return $body;
    }

    /**
     * Replace the Extra Parameter
     *
     * @param $value
     * @param $body
     * @return mixed
     */
    public function replaceExtraParameter($value,$body,$extra)
    {
        $item['body']['text'] = $body;
        $extra=json_decode($extra);
        foreach ($extra as $key => $extraValue) {
            $item['body']['text'] = preg_replace(
                "{{extra.".$key."}}",
                $extraValue,
                $item['body']['text']
            );
        }
        return $item['body']['text'];
    }
}
