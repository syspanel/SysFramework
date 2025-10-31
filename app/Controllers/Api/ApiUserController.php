<?php  

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace App\Controllers\Api;

use Core\SysController;
use App\Models\User;
use Exception;

/**
 * Class ApiUserController
 *
 * Handles CRUD operations for users via API.
 * All responses are returned in JSON format with appropriate HTTP status codes.
 */
class ApiUserController extends SysController
{
    /**
     * List all users.
     *
     * @return \Core\JsonResponse
     */
    public function index()
    {
        try {
            $users = User::all();
            return $this->jsonResponse($users);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show a single user by ID.
     *
     * @param int $id
     * @return \Core\JsonResponse
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->jsonResponse(['error' => 'User not found'], 404);
            }
            return $this->jsonResponse($user);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Create a new user.
     *
     * @return \Core\JsonResponse
     */
    public function store()
    {
        try {
            $data = $_POST; // You can later replace with a request handler
            $user = new User();
            $user->fill($data);
            $user->save();

            return $this->jsonResponse($user, 201); // HTTP 201 Created
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update an existing user by ID.
     *
     * @param int $id
     * @return \Core\JsonResponse
     */
    public function update($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->jsonResponse(['error' => 'User not found'], 404);
            }

            $data = $_POST;
            $user->fill($data);
            $user->save();

            return $this->jsonResponse($user);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a user by ID.
     *
     * @param int $id
     * @return \Core\JsonResponse
     */
    public function delete($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->jsonResponse(['error' => 'User not found'], 404);
            }

            $user->delete();
            return $this->jsonResponse(['message' => 'User deleted']);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
