<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Orhanerday\OpenAi\OpenAi;

class OpenAiController extends Controller
{
    public function textCompletionPage(Request $request)
    {
        $text = '';
        $data = [];
        return view('open_ai.text-completion', compact('text', 'data'));
    }

    public function textCompletionApi(Request $request)
    {
        try {
            $text = $request->text;
            $openAiKey = env('OPENAI_API_KEY', null);
            $openAi = new OpenAi($openAiKey);
            $stringPrompt = "The following is a list of companies. Fill the properties they contain for each company:
                            companies = { $text }
                            properties = {
                                Name:
                                Customer Count:
                                Size:
                                Category:
                                Industries:
                                Description:
                            }
                            Make Customer Count an expressed integer.
                            Catagorize size based on:
                            if Customer Count < 10000 then 'Small', if Customer Count >= 10000 then 'Medium', if Customer Count > 100000 then 'Large', if Customer Count > 10000000 then 'Giant'";

            $complete = $openAi->completion([
                'model' => 'text-davinci-003',
                'prompt' => $stringPrompt,
                'temperature' => 0,
                'max_tokens' => 350,
            ]);

            $complete = json_decode($complete)->choices[0]->text;

            $data = [];
            $name = strstr($complete, 'Customer Count:', true);
            $data['Name'] = trim(str_replace('Name:', '', $name));

            $count = strstr(str_replace($name, '', $complete), 'Size:', true);
            $customerCount = trim(str_replace('Customer Count:', '', $count));
            $data['Customer_count'] = preg_replace('/[^0-9]+/', '', $customerCount);

            $size = strstr(str_replace($name . $count, '', $complete), 'Category:', true);
            $data['Size'] = trim(str_replace('Size:', '', $size));

            $category = strstr(str_replace($name . $count . $size, '', $complete), 'Industries:', true);
            $data['Category'] = trim(str_replace('Category:', '', $category));

            $industry = strstr(str_replace($name . $count . $size . $category, '', $complete), 'Description:', true);
            $data['Industries'] = trim(str_replace('Industries:', '', $industry));

            $description = str_replace($name . $count . $size . $category . $industry, '', $complete);
            $data['Description'] = trim(str_replace('Description:', '', $description));

            return view('open_ai.text-completion', compact('text', 'data'));

        } catch (Exception $e) {
            Log::error("OpenAiController@textCompletion::Failed", $e->getMessage());
            return back();
        }
    }

    public function imageGeneratePage(Request $request)
    {
        $text = '';
        $data = [];
        return view('open_ai.image-generate', compact('text', 'data'));
    }

    public function imageGenerateApi(Request $request)
    {
        try {
            $text = $request->text;
            $openAiKey = env('OPENAI_API_KEY', null);
            $openAi = new OpenAi($openAiKey);
            $data = $openAi->image([
                'prompt' => $text,
                'n' => 2,
                'size' => '256x256',
                'response_format' => 'url',
            ]);

            // save to local if needed.
//            $file = 'base64_'. md5(Carbon::now()->toDateTimeString());
//            Storage::disk('local')->put($file.'.png', file_get_contents($data["data"][0]["url"]));

            $data = json_decode($data)->data;

            return view('open_ai.image-generate', compact('text', 'data'));

        } catch (Exception $e) {
            Log::error("OpenAiController@imageGenerateApi::Failed", $e->getMessage());
            return back();
        }
    }

    public function textClassificationPage(Request $request)
    {
        $text = '';
        $data = '';
        return view('open_ai.text-classification', compact('text', 'data'));
    }

    public function textClassificationApi(Request $request)
    {
        try {
            $text = $request->text;
            $openAiKey = env('OPENAI_API_KEY', null);
            $openAi = new OpenAi($openAiKey);

            $stringPrompt = "Decide whether a statement's sentiment is positive, neutral, or negative.
                             Statement: '$request->text'
                             Sentiment:";

            $data = $openAi->completion([
                'model' => 'text-davinci-003',
                'prompt' => $stringPrompt,
                'temperature' => 0,
                'max_tokens' => 60,
                'top_p' => 1,
                'frequency_penalty' => 0.5,
                'presence_penalty' => 0
            ]);

            $data = trim(json_decode($data)->choices[0]->text);

            return view('open_ai.text-classification', compact('text', 'data'));

        } catch (Exception $e) {
            Log::error("OpenAiController@textClassificationApi::Failed", $e->getMessage());
            return back();
        }
    }
}
