<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Street;
use App\District;
use App\Common;

class StreetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $streets_quan2 = ['An Phú', 'An Phú Đông 27', 'An Trang', 'B', 'Bát Nàn', 'Bình An', 'Bình Trưng', 'Bùi Tá Hán', 'Cao Đức Lân', 'Đại Lộ Đông Tây', 'Đàm Văn Lễ', 'Đặng Hữu Phổ', 'Đặng Như Mai', 'Đặng Tiến Đông', 'Đỗ Pháp Thuận', 'Đỗ Quang', 'Đỗ Xuân Hợp', 'Đoàn Hữu Trưng', 'Đông Hưng Thuận 6', 'Đồng Quốc Bình', 'Đồng Văn Cống', 'Dư Hàng Kênh', 'Đường A', 'Đường C', 'Dương Văn An', 'G1', 'Giang Văn Minh', 'H', 'Hà Quang', 'Hàn Giang', 'Hậu Lân', 'Hiệp Thành 13', 'Hương lộ 62', 'K', 'KP3', 'Lâm Quang Ký', 'Lê Đình Quản', 'Lê Đức Thọ', 'Lê Hiến Mai', 'Lê Hồng Phong', 'Lê Hữu Kiều', 'Lê Phụng Hiểu', 'Lê Thước', 'Lê Văn Miến', 'Lê Văn Thịnh', 'Lộc Hòa', 'Lương Định Của', 'Lý Ông Trọng', 'Mai Chí Thọ', 'Mương Khai', 'Ngô Quang Huy', 'Nguyễn Án', 'Nguyễn Bá Huân', 'Nguyễn Bá Lân', 'Nguyễn Cừ', 'Nguyễn Đăng Đạo', 'Nguyễn Đăng Giai', 'Nguyễn Địa Lô', 'Nguyễn Đôn Tiết', 'Nguyễn Duy Hiệu', 'Nguyễn Duy Trinh', 'Nguyễn Hoàng', 'Nguyễn Hương', 'Nguyễn Huy Chương', 'Nguyễn Khanh', 'Nguyễn Khoa Đăng', 'Nguyễn Lương Dĩ', 'Nguyễn Quang Bật', 'Nguyễn Quý Cảnh', 'Nguyễn Quý Đức', 'Nguyễn Thanh Sơn', 'Nguyễn Thị Định', 'Nguyễn Trọng Quân', 'Nguyễn Trung Nguyệt', 'Nguyễn Tư Nghiêm', 'Nguyễn Tuyển', 'Nguyễn Ư Dĩ', 'Nguyễn Văn Giáp', 'Nguyễn Văn Hưởng', 'Nguyễn Văn Kỉnh', 'Phạm Công Trứ', 'Phạm Đôn Lễ', 'Phạm Hy Lượng', 'Phạm Thận Duật', 'Phan Bá Vành', 'Phan Văn Đáng', 'Quách Giai', 'Quốc Hương', 'Quốc lộ 1A', 'Song Hành', 'Sử Hy Nhan', 'Tạ Hiện', 'Tân Chánh Hiệp 16', 'Tân Lập 2', 'Tân Thới Hiệp 10', 'Thái Thuận', 'Thân Văn Nhiếp', 'Thạnh Lộc 27', 'Thạnh Mỹ Bắc', 'Thạnh Mỹ Lợi', 'Thạnh Mỹ Nam', 'Thạnh Xuân 13', 'Thạnh Xuân 21', 'Thảo Điền', 'Thích Mật Thể', 'Tỉnh Lộ 10', 'Tỉnh lộ 25B', 'Tống Hữu Định', 'Trại Gà', 'Trần Lưu', 'Trần Lựu', 'Trần Não', 'Trần Ngọc Diện', 'Trần Quang Đạo', 'Trích Sài', 'Trịnh Khắc Lập', 'Trúc Đường', 'Trương Gia Mô', 'Trương Văn Bang', 'Trương Văn Đa', 'Vạn Kiếp', 'Vành Đai 2', 'Vành Đai Đông', 'Võ Trường Toản', 'Võ Văn Kiệt', 'Vũ Phương Đế', 'Vũ Tông Phan', 'Xa Lộ Hà Nội', 'Xuân Thủy'];
        $quan2 = District::where('key','quan-2')->get();
        $quan2_id = 2;
        $quan2_name = 'Quận 2';
        if(is_null($quan2) || $quan2->count() ==0)
        {
        	$quan2_id = $quan2_id[0]->id;
        	$quan2_name = $quan2_id[0]->name;
        }
        foreach ($streets_quan2 as $key => $value) 
        {
	        $street = Street::create([
				'key' => Common::createKeyURL($value.' '.$quan2_name),
                'name' => $value,
                'district_id' => $quan2_id,
                'meta_description' => 'Bán căn hộ đường phố '.$value .' '. $quan2_name . ', sang nhượng căn hộ đường phố '.$value .' '. $quan2_name . ', cho thuê căn hộ đường phố '.$value .' ' . $quan2_name,
                'meta_keywords' => 'Bán căn hộ đường phố '.$value .' '. $quan2_name . ', sang nhượng căn hộ đường phố '.$value .' '. $quan2_name . ', cho thuê căn hộ đường phố '.$value .' ' . $quan2_name,
				'priority' => $key,
				'is_publish' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
        }
    }
}
