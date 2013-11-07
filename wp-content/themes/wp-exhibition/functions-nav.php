<?php
class MBT_Walker_Nav_Menu extends Walker_Nav_Menu{

    /**
     * Walker class에 있는 walk 함수를 복사한 뒤 아래 코드만 추가한 것임.
     * 1. 탑 레벨 메뉴에 main-nav__li1이라는 클래스를 붙인다.
     * 2. 서브메뉴를 가진 탑레벨 메뉴에는 'main-nav__li1--has-child'라는 클래스를 붙인다.
     * 
     * $e->classes[] = 'main-nav__li1';
     * if( ! empty($children_elements)){
     *     $e->classes[] = 'main-nav__li1--has-child';
     * }
     *  
     * Display array of elements hierarchically.
     *
     * It is a generic function which does not assume any existing order of
     * elements. max_depth = -1 means flatly display every element. max_depth =
     * 0 means display all levels. max_depth > 0  specifies the number of
     * display levels.
     *
     * @since 2.1.0
     *
     * @param array $elements
     * @param int $max_depth
     * @return string
     */
    function walk( $elements, $max_depth) {

        $args = array_slice(func_get_args(), 2);
        $output = '';

        if ($max_depth < -1) //invalid parameter
            return $output;

        if (empty($elements)) //nothing to walk
            return $output;

        $id_field = $this->db_fields['id'];
        $parent_field = $this->db_fields['parent'];

        // flat display
        if ( -1 == $max_depth ) {
            $empty_array = array();
            foreach ( $elements as $e )
                $this->display_element( $e, $empty_array, 1, 0, $args, $output );
            return $output;
        }

        /*
         * need to display in hierarchical order
         * separate elements into two buckets: top level and children elements
         * children_elements is two dimensional array, eg.
         * children_elements[10][] contains all sub-elements whose parent is 10.
         */
        $top_level_elements = array();
        $children_elements  = array();
        foreach ( $elements as $e) {
            if ( 0 == $e->$parent_field )
                $top_level_elements[] = $e;
            else
                $children_elements[ $e->$parent_field ][] = $e;
        }

        /*
         * when none of the elements is top level
         * assume the first one must be root of the sub elements
         */
        if ( empty($top_level_elements) ) {

            $first = array_slice( $elements, 0, 1 );
            $root = $first[0];

            $top_level_elements = array();
            $children_elements  = array();
            foreach ( $elements as $e) {
                if ( $root->$parent_field == $e->$parent_field )
                    $top_level_elements[] = $e;
                else
                    $children_elements[ $e->$parent_field ][] = $e;
            }
        }

        foreach ( $top_level_elements as $e ){
            $e->classes[] = 'main-nav__li1';
            if( ! empty($children_elements[$e->ID])){
                $e->classes[] = 'main-nav__li1--has-child';
            }
            $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
        }

        /*
         * if we are displaying all levels, and remaining children_elements is not empty,
         * then we got orphans, which should be displayed regardless
         */
        if ( ( $max_depth == 0 ) && count( $children_elements ) > 0 ) {
            $empty_array = array();
            foreach ( $children_elements as $orphans )
                foreach( $orphans as $op )
                    $this->display_element( $op, $empty_array, 1, 0, $args, $output );
         }

         return $output;
    }
}