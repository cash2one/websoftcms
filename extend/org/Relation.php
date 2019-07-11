<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/12/6
 * Time: 18:52
 * Relation.php
 * version:v1.3
 */
namespace org;
class Relation
{
    /**
     * @param $model
     * @param $lng
     * @param $lat
     * @param $house_id
     * 添加至房源与地铁站关联表
     */
    public static function addMetro($model,$lng,$lat,$house_id,$city)
    {
        try{
            if($lng && $lat)
            {
                $city_id = model('city')->getTopParentChild($city);
                $metro_distance = getSettingCache('site','metro_distance');
                $metro_distance = is_numeric($metro_distance) ? $metro_distance : 500;
                $obj        = model('metro');
                $join       = [['metro_station s','s.metro_id = m.id']];
                $point      = "s.id,s.metro_id,s.name,s.metro_name,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(({$lat}*PI()/180-lat*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(lat*PI()/180)*POW(SIN(({$lng}*PI()/180-lng*PI()/180)/2),2)))*1000) as distance";
                $bindsql    = $obj->alias('m')->join($join)->field($point)->where('m.city',$city_id)->where('m.status',1)->where('s.status',1)->buildSql();;
                $fields_res = 'id,metro_id,name,metro_name,distance';
                $lists      = $obj->table($bindsql.' d')->field($fields_res)->where('distance','elt',$metro_distance)->select();
                $metroObj   = model('metro_relation');
                if(!$lists->isEmpty())
                {
                    foreach($lists as $v)
                    {
                        $data = [
                            'model' => $model,
                            'house_id' => $house_id,
                            'distance' => $v['distance'],
                            'metro_id' => $v['metro_id'],
                            'station_id' => $v['id'],
                            'metro_name' => $v['metro_name'],
                            'station_name' => $v['name']
                        ];
                        if($metroObj->where(['model'=>$model,'house_id'=>$house_id,'station_id'=>$v['id']])->find())
                        {
                            $metroObj->save($data,['model'=>$model,'house_id'=>$house_id,'station_id'=>$v['id']]);
                        }else{
                            $metroObj->isUpdate(false)->save($data);
                        }
                        unset($metroObj->id);
                    }
                }
            }
        }catch(\Exception $e){
            \think\facade\Log::write($e->getFile().$e->getMessage(),'error');
        }
    }

    /**
     * @param $model
     * @param $lng
     * @param $lat
     * @param $house_id
     * 学校与房源关联关系
     */
    public static function addSchool($model,$lng,$lat,$house_id,$city)
    {
        try{
            if($lng && $lat)
            {
                $ids = model('city')->getTopParentChild($city,true);
                $school_distance = getSettingCache('site','school_distance');
                $school_distance = is_numeric($school_distance) ? $school_distance : 500;
                $obj        = model('school');
                $point      = "*,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(({$lat}*PI()/180-lat*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(lat*PI()/180)*POW(SIN(({$lng}*PI()/180-lng*PI()/180)/2),2)))*1000) as distance";
                $bindsql    = $obj->field($point)->where('city','in',$ids)->buildSql();
                $fields_res = 'id,title,distance';
                $lists      = $obj->table($bindsql.' d')->field($fields_res)->where('status',1)->where('distance','elt',$school_distance)->select();
                $schoolObj  = model('school_relation');
                if(!$lists->isEmpty())
                {
                    foreach($lists as $v)
                    {
                        $data = [
                            'model' => $model,
                            'house_id' => $house_id,
                            'distance' => $v['distance'],
                            'school_id' => $v['id'],
                            'school_name' => $v['title']
                        ];
                        if($schoolObj->where(['house_id'=>$house_id,'model'=>$model,'school_id'=>$v['id']])->find())
                        {
                            $schoolObj->save($data,['house_id'=>$house_id,'model'=>$model,'school_id'=>$v['id']]);
                        }else{
                            $schoolObj->isUpdate(false)->save($data);
                        }
                        unset($schoolObj->id);
                    }
                }
            }
        }catch(\Exception $e){
            \think\facade\Log::write($e->getFile().$e->getMessage(),'error');
        }

    }

    /**
     * @param $metro_id
     * 根据地地铁线删除关联关系
     */
    public static function deleteByMetro($metro_id)
    {
        model('metro_relation')->where('metro_id',$metro_id)->delete();
    }

    /**
     * @param $station_id
     * 根据车站删除关联关系
     */
    public static function deleteByStation($station_id)
    {
        model('metro_relation')->where('station_id',$station_id)->delete();
    }

    /**
     * @param $school_id
     * 根据学校id删除关联关系
     */
    public static function deleteBySchool($school_id)
    {
        model('school_relation')->where('school_id',$school_id)->delete();
    }

    /**
     * @param $house_id
     * @param $model
     * @param string $table
     * 根据房源id删除关联关系
     */
    public static function deleteByHouse($house_id,$model,$table = 'metro')
    {
        if($table == 'metro' || $table == 'school')
        {
            model($table.'_relation')->where('house_id',$house_id)->where('model',$model)->delete();
        }
    }
}