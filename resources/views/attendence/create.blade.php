<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>   
</head>
<body>

     <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Import Excel
                        </div>
                        <div class="card-body">
                            <!--  
                            <form method="POST" enctype="multipart/form-data" action="{{route('attendence.create')}}">
                                @csrf
                                <div class="from-group">
                                    <lebel for="file">Choose CSV </label>
                                    <input type="file" name="file" class="form-control"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            -->
                                <!-- weekly record -->
                                <form method="POST" enctype="multipart/form-data" action="{{route('monthly_attendence.import')}}">
                                @csrf
                                <div class="from-group">
                                    <lebel for="file">Choose XLSX For Weekly Attendence</label>
                                    <input type="file" name="file" class="form-control mt-2"/>
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Submit</button>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    
     </section>
 </body>
</html> 

