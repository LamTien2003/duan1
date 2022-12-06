function fetchChart() {
    $.ajax({
        url:"ajax/chart.php",
        method: "POST",
        data: {
            action: 'fetchChart',
        },
        success: function (data) {
            const fetchData = JSON.parse(data);
            const dataBill = fetchData.bill
            const dataProduct = fetchData.product
            const dataCategory = fetchData.category
            console.log(dataCategory)
            const ctx = document.getElementById('myChart');
            const barChart1 = document.getElementById('bar-chart1');
            const barChart2 = document.getElementById('bar-chart2');

            new Chart(ctx, {
            type: 'line',
            data: {
              labels: dataBill.map((item) => item.ngay),
              datasets: [{
                label: 'SỐ ĐƠN ĐẶT HÀNG',
                data: dataBill.map((item) => item.soluong),
                borderWidth: 1,
                fill: {
                    target: 'origin',
                    above: '#ddeefa',  
                },
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15,
              }]
            },
            options: {
                plugins: {
                    title: {
                    display: true,
                    text: 'THỐNG KÊ SỐ LƯỢNG ĐƠN HÀNG THEO NGÀY'
                    },
                },
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            }       
        });

        new Chart(barChart1, {
            type: 'pie',
            data: {
              labels: dataProduct.map((item) => item.title_product),
              datasets: [{
                label: 'SỐ LƯỢNG BÁN RA',
                data: dataProduct.map((item) => item.sold),
              }]
            },
            options: {
                plugins: {
                    title: {
                    display: true,
                    text: 'TOP 5 SẢN PHẨM BÁN CHẠY NHẤT'
                    },
                },
                scales: {
                    
                }
            }       
        });

        new Chart(barChart2, {
            type: 'doughnut',
            data: {
              labels: dataCategory.map((item) => item.name_category),
              datasets: [{
                label: 'SỐ LƯỢNG BÁN RA',
                data: dataCategory.map((item) => item.sold),
              }]
            },
            options: {
                plugins: {
                    title: {
                    display: true,
                    text: 'TOP 5 DANH MỤC SẢN PHẨM BÁN CHẠY'
                    },
                },
                scales: {
                    
                }
            }       
        });
        
        }
    })

}
fetchChart();