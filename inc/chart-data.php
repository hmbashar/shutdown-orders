<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


function ssol_bar_chart_data($newPlotID = 'ssol_chart_data')
{
  //  if ( is_page_template( 'ssolshutdown.php' ) ) { // check if this templete then show the chart data

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
                        color: '#004825'
                    }
                };

                var trace2<?php echo $term->term_id; ?> = {
                    x: ['<?php echo strtoupper($term->slug); ?>'],
                    y: [<?php echo  $countyCount; ?>],
                    name: 'County',
                    type: 'bar',
                    marker: {
                        color: 'rgb(233, 180, 70)'
                    }

                };

                // var trace3<?php echo $term->term_id; ?> = {
                //     x: ['<?php echo strtoupper($term->slug); ?>'],
                //     y: [<?php echo $stateCount; ?>],
                //     name: 'City',
                //     type: 'bar',
                //     marker: {
                //         color: 'rgb(56, 209, 135)'
                //     }
                // };
              

                datas.push(trace1<?php echo $term->term_id; ?>);
                datas.push(trace2<?php echo $term->term_id; ?>);
               // datas.push(trace3<?php echo $term->term_id; ?>);

            </script>
    <?php


        endforeach;
    }
    ?>

    <?php
    ?>

    <script>      

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

        Plotly.newPlot(<?php echo $newPlotID?>, datas, layout);
    </script>

<?php
   // } // condation end for page template
}

//add_action('wp_footer', 'ssol_bar_chart_data');


