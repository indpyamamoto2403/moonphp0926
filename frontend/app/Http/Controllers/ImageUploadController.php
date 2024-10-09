namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // バリデーション
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // publicディスクに保存
            return response()->json(['path' => Storage::url($path)], 200);
        }

        return response()->json(['message' => '画像がアップロードされませんでした。'], 400);
    }
}
