<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ $subject }}</title>
    </head>
   
    <body style="background-color: #eff2f7; padding: 30px 20px;">
        <div style="max-width: 800px; margin: auto;">
            <div style="margin-bottom: 20px; display: inline-block;">
                <img style="width: 40px;" src="{{ $message->embed( $logo ) }}">&nbsp;
                <a href="" style="top: 40px; text-transform:uppercase; font-size: 18px; font-weight: bold; position: absolute;">{{ $c_name }}</a>
            </div>
            <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 16px;">Welcome to <a style="text-decoration: none;" href="https://cityfoods.online/" style="">{{ $c_name }}</a></span>
            </div>
            <div style="margin-bottom: 10px; text-align: justify;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br><br>

                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <hr style="margin-bottom: 10px;">
            
            <div style="text-align: center; margin-bottom: 10px; margin-top: 20px;">{{ $c_name }} syncs across all your devices.</div>
            <div style="text-align: center; margin-bottom: 10px;">
                <!-- <div style="display: inline-block; margin-right: 10px"><a href="https://cityfoods.online/">Windows</a></div> -->
                <!-- <div style="display: inline-block; margin-right: 10px"><a href="{{ $mac }}">Mac</a></div> -->
                <div style="display: inline-block; margin-right: 10px"><a style="text-decoration: none;" href="{{ $android }}"><img style="width: 100px;" src="{{ $message->embed(public_path('imgs/playstore.png')) }}"></a></div>
                <div style="display: inline-block; margin-right: 10px"><a style="text-decoration: none;" href="{{ $ios }}"><img style="width: 100px;" src="{{ $message->embed(public_path('imgs/appstore.png')) }}"></a></div>
            </div>

        </div>
    </body>
</html>
