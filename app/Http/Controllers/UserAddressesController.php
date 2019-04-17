<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;

class UserAddressesController extends Controller
{
    /**
     * 视图展示
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        return view('user_addresses.index', [
            'addresses' => $request->user()->addresses,
        ]);
    }

    /**
     * 添加收货地址视图
     * @return [type] [description]
     */
    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    /**
     * 执行添加收货地址
     * @param  UserAddressRequest $request [description]
     * @return [type]                      [description]
     */
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    /**
     * 编辑收货地址
     * @param  UserAddress $user_address [description]
     * @return [type]                    [description]
     */
    public function edit(UserAddress $user_address)
    {
        //权限
        $this->authorize('own', $user_address);

        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    /**
     * 执行编辑收货地址
     * @param  UserAddress        $user_address [description]
     * @param  UserAddressRequest $request      [description]
     * @return [type]                           [description]
     */
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        //权限
        $this->authorize('own', $user_address);

        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    /**
     * 删除收货地址
     * @param  UserAddress $user_address [description]
     * @return [type]                    [description]
     */
    public function destroy(UserAddress $user_address)
    {
        //权限
        $this->authorize('own', $user_address);

        $user_address->delete();
        // 把之前的 redirect 改成返回空数组
        return [];
    }
}
