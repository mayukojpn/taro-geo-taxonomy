<?php

namespace Taro\GeoTaxonomy\Models;


use Taro\Common\Pattern\Model;

/**
 * Point class
 *
 * @package Taro\GeoTaxonomy\Models
 */
class Point extends Model
{

	protected $name = 'points';

	protected $version = '1.0';

	/**
	 * Create points table
	 *
	 * @return string
	 */
	protected function create_sql() {
		return <<<SQL
			CREATE TABLE `{$this->table}` (
				point_id    BIGINT NOT NULL AUTO_INCREMENT,
				point_key VARCHAR(48) NOT NULL,
				object_id   BIGINT NOT NULL,
				latlng      GEOMETRY NOT NULL,
				point_name  VARCHAR(256) NOT NULL,
				point_desc TEXT NOT NULL,
				PRIMARY KEY (point_id),
				INDEX from_key (point_key, object_id),
				INDEX from_id (object_id),
				INDEX from_name (point_key, point_name(9)),
				SPATIAL KEY (latlng)
			) ENGINE = MyISAM DEFAULT CHARSET utf8
SQL;
	}

	/**
	 * Add GEOM data
	 *
	 * @param string $key
	 * @param int $object_id
	 * @param float $lat
	 * @param float $lng
	 * @param string $name
	 * @param string $desc
	 *
	 * @return bool
	 */
	public function add_point($key, $object_id, $lat, $lng, $name = '', $desc = ''){
		$query = <<<SQL
			INSERT INTO {$this->table} (
				point_key, object_id, latlng, point_name, point_desc
			) VALUES (
				%s, %d, GeomFromText(%s), %s, %s
			)
SQL;
		$query = $this->db->prepare($query, $key, $object_id, $this->db->prepare('POINT(%f %f)', $lng, $lat), $name, $desc);
		return (bool) $this->db->query($query);
	}

	/**
	 * Get points
	 *
	 * @param string $key
	 * @param int $object_id
	 * @param bool $single If false, return array
	 *
	 * @return null|\stdClass|array
	 */
	public function get_points($key, $object_id, $single = true){
		$query = <<<SQL
			SELECT
				point_key, point_name, point_desc,
				X(latlng) AS lng, Y(latlng) AS lat
			FROM {$this->table}
			WHERE point_key = %s AND object_id = %d
SQL;
		if( $single ){
			return $this->get_row($query, $key, $object_id);
		}else{
			return $this->get_results($query, $key, $object_id);
		}
	}

}