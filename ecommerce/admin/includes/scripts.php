<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        var ctx = document.getElementById('brandPopularityChart').getContext('2d');

        <?php
        $query = "SELECT b.name, COUNT(*) as order_count
                FROM orders o
                JOIN order_details od ON od.order_id = o.order_id
                JOIN products p ON od.product_id = p.product_id
                JOIN brand b ON p.brand_id = b.brand_id
                GROUP BY b.name
                ORDER BY order_count DESC";
        $query_run = mysqli_query($con, $query);

        $labels = [];
        $data = [];

        while ($row = mysqli_fetch_assoc($query_run)) {
                $labels[] = $row['name'];
                $data[] = $row['order_count'];
        }
        ?>

        var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                label: 'Number of Orders',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                'pink',
                'lightyellow',
                'lightgreen',
                'lightblue',
                'violet',
                '#48CFAD'
                ],
                borderColor: [
                'red',
                'yellow',
                'green',
                'blue',
                'purple',
                '#37BC9B'
                ],
                borderWidth: 2
                }]
        },
        options: {
                scales: {
                y: {
                        beginAtZero: true
                }
                }
        }
        });
</script>

<script>
        var ctx = document.getElementById('salesChart').getContext('2d');

        <?php
                $query = "SELECT DATE(created_at) as date, SUM(grand_total) as total_sales
                        FROM orders
                        GROUP BY DATE(created_at)
                        ORDER BY DATE(created_at)";
                $query_run = mysqli_query($con, $query);

                $labels = [];
                $data = [];

                while ($row = mysqli_fetch_assoc($query_run)) {
                $labels[] = $row['date'];
                $data[] = $row['total_sales'];
                }
        ?>

        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                label: 'Sales (RM)',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(144, 238, 144, 0.2)',
                borderColor: 'rgba(144, 238, 144, 1)',
                borderWidth: 3
                }]
        },
        options: {
                scales: {
                y: {
                        beginAtZero: true
                }
                }
        }
        });
</script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
