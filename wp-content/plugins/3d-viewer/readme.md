## Pro filter hooks

1. bp3d_woocommerce_model_attribute

Example

```
add_filter('bp3d_woocommerce_model_attribute', function($default){
    return wp_parse_args([
        'id' => 'model_custom_id'
    ], $default);
})
```

## shortcode

1. [3d_viewer_product]
   ## _params_
   ### width
    <ul>
        <li>type String</li>
    </ul>
