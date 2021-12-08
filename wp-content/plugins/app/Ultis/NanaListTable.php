<?php

namespace Nana\Ultis;

defined( 'ABSPATH' ) || exit;
if( ! class_exists( '\WP_List_Table' ) ) {
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php') ;
}

class NanaListTable extends \WP_List_Table
{
    /**
     * Array of table headers
     *
     * The format is:
     * - `'internal-name' => 'Title'`
     *
     * @var array $headers
     * @since 3.1.0
     *
     */
    public array $headers = [];

    /**
     * Array of table data
     *
     * The format is:
     * - `'internal-name' => 'Data'`
     *
     * @var array $data
     * @since 3.1.0
     *
     */
    public array $data = [];

    public int $per_page = 10;


    /**
     * Prepares the list of items for displaying.
     *
     * @uses WP_List_Table::set_pagination_args()
     *
     * @since 3.1.0
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $sortable = $this->get_sortable_columns();
        $hidden = array();

        $currentPage = $this->get_pagenum();
        $totalItems = count($this->data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $this->per_page
        ));

        $data = array_slice($this->data, (($currentPage - 1) * $this->per_page), $this->per_page);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Return value of a column
     *
     * @param array|object $item
     * @param string $column_name
     * @return mixed|void
     */
    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    /**
     * Gets a list of columns.
     *
     * The format is:
     * - `'internal-name' => 'Title'`
     *
     * @return array
     * @since 3.1.0
     *
     */
    public function get_columns(): array
    {
        $columns = [];

        foreach ($this->headers as $header) {
            $columns[$header['id']] = $header['title'];
        }

        return $columns;
    }

    /**
     * Gets a list of sortable columns.
     *
     * The format is:
     * - `'internal-name' => 'orderby'`
     * - `'internal-name' => array( 'orderby', 'asc' )` - The second element sets the initial sorting order.
     * - `'internal-name' => array( 'orderby', true )`  - The second element makes the initial order descending.
     *
     * @return array
     * @since 3.1.0
     *
     */
    protected function get_sortable_columns(): array
    {
        $sortables = [];

        foreach ($this->get_columns() as $key => $column) {
            if (isset($column['sortable']) && $column['sortable']) {

                $orderby = 'desc';

                if (isset($column['orderby'])) {
                    $orderby = $column['orderby'];
                }

                $sortables[$key] = [
                    'orderby',
                    $orderby
                ];
            }
        }

        return $sortables;
    }

    /**
     * Render Table HTML
     */
    public function display()
    {
        $this->prepare_items();

        parent::display();
    }

    /**
     * Override this function to remove Nonce field
     * Generates the table navigation above or below the table
     *
     * @param string $which
     * @since 3.1.0
     */
    protected function display_tablenav($which)
    {
        ?>
        <div class="tablenav <?php echo esc_attr($which); ?>">

            <?php if ($this->has_items()) : ?>
                <div class="alignleft actions bulkactions">
                    <?php $this->bulk_actions($which); ?>
                </div>
            <?php
            endif;
            $this->extra_tablenav($which);
            $this->pagination($which);
            ?>

            <br class="clear"/>
        </div>
        <?php
    }

    /**
     * Generates the tbody element for the list table.
     *
     * @since 3.1.0
     */
    public function display_rows_or_placeholder()
    {
        $this->display_rows();
    }
}