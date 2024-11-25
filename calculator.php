<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-96 animate-fade-in-down">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Calculator</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="space-y-4">
            <input 
                type="number" 
                name="num1" 
                id="num1" 
                placeholder="Enter Number 1" 
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required 
            />
            <select 
                name="operator" 
                id="operator" 
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="add">+</option>
                <option value="subract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input 
                type="number" 
                name="num2" 
                id="num2" 
                placeholder="Enter Number 2" 
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required 
            />
            <button 
                type="submit" 
                name="submit" 
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-transform transform hover:scale-105">
                Calculate
            </button>
        </form>
        <div class="mt-6">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $num1= filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
                $num2= filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
                $operator = htmlspecialchars($_POST['operator']);
                $errors = false;

                if(empty($num1) || empty($num2) || empty($operator)){
                    echo "<p class='text-red-500 text-center'>Please fill in all fields.</p>";
                    $errors = true;
                }

                if(!is_numeric($num1) || !is_numeric($num2)){
                    echo "<p class='text-red-500 text-center'>Please enter valid numbers.</p>";
                    $errors = true;
                }

                if($errors == false){
                    switch($operator){
                        case 'add':
                            echo "<p class='text-green-600 text-center'>Result: " . ($num1 + $num2) . "</p>";
                            break;
                        case 'subract':
                            echo "<p class='text-green-600 text-center'>Result: " . ($num1 - $num2) . "</p>";
                            break;
                        case 'multiply':
                            echo "<p class='text-green-600 text-center'>Result: " . ($num1 * $num2) . "</p>";
                            break;
                        case 'divide':
                            if($num2 == 0){
                                echo "<p class='text-red-500 text-center'>Cannot divide by zero.</p>";
                            } else {
                                echo "<p class='text-green-600 text-center'>Result: " . ($num1 / $num2) . "</p>";
                            }
                            break;
                        default:
                            echo "<p class='text-red-500 text-center'>Invalid operator.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>
</body>
</html>
