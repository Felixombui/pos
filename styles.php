<html>

<head>
    <title><?php echo $shopname ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
        body {
            font-family:'Segoe UI';
            background-color: none;
        }
        .header{
           
            left: 0;
            top: 0;
            
            padding: 12px;
            background-color: darkorange;
            color: whitesmoke;
        }
    </style>
    <style>
        .split{
            position: fixed;
            /*overflow-x: hidden;*/
            overflow: scroll;
        }
        .leftmenu{
            /*left: 0;*/
            background-color: darkorange;
            width: 15%;
            padding: 2px; 
            margin-top: 5px;
            height: 70%;
            color: white;
            float: left;
        }
        .leftmenu a{
            color: blue;
            text-decoration: none;
            
            padding-right:50%;
        }
        .leftmenu tr{
            padding: 5px;
            color: white;
        }
        .leftmenu tr:hover{
            background-color: grey;
            color: white;
        }
        .leftmenu a{
            color: white;
        }
        .right{
            width: 83%;
            padding: 2px;
            margin-top: 5px;
            float: left;
            height: 70%;
            margin-left: 10px;
            border:1px solid pink;
        }
        .subheader{
            background-color: blue;
            color: white;
            margin-top: 5px;
            padding: 15px;
        }
        
        .summary{
            width: 100px;
            height: 100px;
            margin-left: 10px;
            border: 1px solid pink;
            border-radius: 5px;
            box-shadow: 2px 2px 2px grey;
            float: left;
            text-align: center;
            margin-top: 10px;
        }
        .loginform{
            margin-top: 10%;
            margin-left: 40%;
            width: 20%;
            text-align: center;
        }
        .loginform input{
            width: 100%;
            padding: 8px;
            margin-top: 6px;
        }
        .dataform{
            width: 30%;
            margin-top: 10px;
            margin-left: 35%;
            border:1px solid pink;
            padding:5px;
        }
        .dataform input{
            width:100%;
            padding: 8px;
            margin-top: 6px;
        }
        .dataform select{
            width:100%;
            padding: 8px;
            margin-top: 6px;
        }
        .rightheader{
            background-color:none;
            color:brown;
            font-weight: bold;
            border-bottom: 1px solid pink;
            padding-bottom:28px;
        }
        th{
            background-color: orange;
            color: white;
            text-align: left;
        }
        tr:hover{
            background-color: silver;
        }
        .itemsmenu{
            margin-top: 50px;
            border: 1px solid pink;
            box-shadow: 2px 2px 2px grey;
            width: 150px;
            height: 120px;
            float:left;
            margin-right: 10px;
            margin-left: 10px;
        }
        .cart{
            width: 100%;
        }
        .cart td{
            border: 1px solid pink;
        }
        .complete tr:hover{
            background-color: none;
        }
        .complete input{
            padding:8px;
        }
        .complete input[type=submit]{
            background-color: green;
            cursor: pointer;
            
        }
        .searchbar input{
                padding:8px;
                margin-top: 10px;
        }
        </style>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: silver;/*#4CAF50;*/
            color: white;
            text-align: center;
            padding: 5px;
        }
        a{
        text-decoration: none;
        color: blueviolet;
        
        }
    </style>