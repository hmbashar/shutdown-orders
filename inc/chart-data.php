<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


function customscript()
{

    // Get the taxonomy's terms
    $terms = get_terms(
        array(
            'taxonomy'      => 'ssol-category', // taxonomy register name
            'hide_empty'    => false, // get all taxonomy terms
            'parent'        => 0, //get only parent taxonomy
        )
    );

    // Create an empty array to store the term names
    $term_slugs = array();
    // $countyCount = array();
    // $stateCount = array();

    $allstatedata = array();

    // Check if any term exists
    if (!empty($terms) && is_array($terms)) {
        // Run a loop and print them all
    ?>
        <script>
            var datas = [];
        </script>
        <?php
        foreach ($terms as $term) :
            $term_slugs[] = strtoupper($term->slug); // set all term slug in array  

            $countyCount =  ssol_get_terms_postcount($term->term_id, 'ssol-category', false);
            $stateCount = ssol_get_terms_postcount($term->term_id, 'ssol-category', true);
        ?>
            <script>
                var trace1<?php echo $term->term_id; ?> = {
                    x: ['<?php echo strtoupper($term->slug); ?>'],
                    y: [<?php echo $stateCount; ?>],
                    name: 'State',
                    type: 'bar',
                    marker: {
                        color: 'rgb(24, 44, 86)'
                    }
                };

                var trace2<?php echo $term->term_id; ?> = {
                    x: ['<?php echo strtoupper($term->slug); ?>'],
                    y: [<?php echo  $countyCount; ?>],
                    name: 'County',
                    type: 'bar',
                    marker: {
                        color: 'rgb(45, 170, 228)'
                    }

                };

                var trace3<?php echo $term->term_id; ?> = {
                    x: ['<?php echo strtoupper($term->slug); ?>'],
                    y: [<?php echo $stateCount; ?>],
                    name: 'City',
                    type: 'bar',
                    marker: {
                        color: 'rgb(56, 209, 135)'
                    }
                };
                // var datas = [trace1<?php echo $term->term_id; ?>, trace2<?php echo $term->term_id; ?>, trace3<?php echo $term->term_id; ?>];

                datas.push(trace1<?php echo $term->term_id; ?>);
                datas.push(trace2<?php echo $term->term_id; ?>);
                datas.push(trace3<?php echo $term->term_id; ?>);
            </script>
    <?php


        endforeach;
    }
    ?>

    <?php
    ?>

    <script>
        var xValue = <?php echo json_encode($term_slugs); ?>;
        console.log(xValue);
        // var xValue = 'NY';
        var trace1 = {
            x: ['NY'],
            y: [2],
            name: 'State',
            type: 'bar',
        };

        var trace2 = {
            x: ['NY'],
            y: [1],
            name: 'County',
            type: 'bar',

        };

        var trace3 = {
            x: ['NY'],
            y: [3],
            name: 'City',
            type: 'bar',
        };
        var trace12 = {
            x: ['MX'],
            y: [2],
            name: 'State',
            type: 'bar',
        };

        var trace22 = {
            x: ['MX'],
            y: [1],
            name: 'County',
            type: 'bar',

        };

        var trace32 = {
            x: ['MX'],
            y: [3],
            name: 'City',
            type: 'bar',
        };


        var data = [trace1, trace2, trace3, trace12, trace22, trace32];
        console.log(data);

        var layout = {
            barmode: 'stack',
            title: 'Shutdowns by State',
            bargap: 0.05,
            font: {
                family: 'Raleway, sans-serif'
            },
            // showlegend: false,
            xaxis: {
                tickangle: -45
            },
            // yaxis: {
            //     zeroline: false,               
            // },
        };

        Plotly.newPlot('myDiv', datas, layout);
    </script>

<?php
}

add_action('wp_footer', 'customscript');
