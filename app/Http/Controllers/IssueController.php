<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueDeleteRequest;
use App\Http\Requests\IssueShowRequest;
use App\Http\Requests\IssueStoreRequest;
use App\Http\Requests\IssueUpdateRequest;
use App\Http\Resources\IssueResource;
use App\Services\IssueService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

/**
    @OA\Info(
        title="Laravel-Project API Documentation",
        version="1.0.0",
    )
 */
class IssueController extends Controller
{
    /**
     * @param IssueService $service
     * @return AnonymousResourceCollection
     *
     * @OA\Get(
     *     path="/api/all",
     *     operationId="issueAll",
     *     tags={"Issue"},
     *     summary="Get all of the issues",
     *      @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *     ),
     * )
     *
     */
    public function index(IssueService $service): AnonymousResourceCollection
    {
        return $service->indexIssues();
    }

    /**
     * @param IssueStoreRequest $request
     * @param IssueService $service
     * @return IssueResource
     *
     * @OA\Post(
     *     path="/api/store",
     *     operationId="issueCreate",
     *     tags={"Issue"},
     *     summary="Create a new issue",
     *     @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for testing",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="output_example",
     *                type="array",
     *                example={{
     *                  "id": "120",
     *                  "title": "some_title",
     *                  "description": "some_description",
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example="",
     *                      ),
     *                      @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="",
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="",
     *                      ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Parameter(
     *      name="title",
     *      in="query",
     *      description="Issue title",
     *      required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Issue description",
     *      required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *     ),
     * )
     */
    public function store(IssueStoreRequest $request, IssueService $service): IssueResource
    {
        return $service->createIssue($request);
    }

    /**
     * @param IssueShowRequest $request
     * @param IssueService $service
     * @return IssueResource
     *
     * @OA\Get(
     *     path="/api/show",
     *     operationId="issueShow",
     *     tags={"Issue"},
     *     summary="Show current issue",
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Issue id",
     *      required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *     ),
     * )
     */
    public function show(IssueShowRequest $request, IssueService $service): IssueResource
    {
        return $service->showIssue($request->input('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param IssueDeleteRequest $request
     * @param IssueService $service
     * @return IssueResource
     *
     * @OA\Put(
     *     path="/api/update",
     *     summary="Update the issue",
     *     tags={"Issue"},
     *     @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for testing",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                type="array",
     *                example={{
     *                  "id": "120",
     *                  "name": "new_title",
     *                  "description": "new_description",
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="",
     *                      ),
     *                      @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="",
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="",
     *                      ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Issue id",
     *          required=true,
     *              @OA\Schema(
     *                  type="integer"
     *              )
     *          ),
     *
     *      @OA\Parameter(
     *          name="title",
     *          in="query",
     *          description="Issue title",
     *          required=true,
     *              @OA\Schema(
     *                  type="string"
     *              )
     *          ),
     *
     *        @OA\Parameter(
     *          name="description",
     *          in="query",
     *          description="Issue description",
     *          required=true,
     *              @OA\Schema(
     *                  type="string"
     *              )
     *          ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful response",
     *     ),
     *     @OA\Response(
     *        response="500",
     *        description="Server error",
     *     ),
     * )
     */
    public function update(Request $request, IssueService $service): IssueResource
    {
        return $service->updateIssue($request);
    }

    /**
     * Display the specified resource.
     *
     * @param IssueDeleteRequest $request
     * @param IssueService $service
     * @return int
     *
     * @OA\DELETE(
     *     path="/api/delete",
     *     summary="Delete the issue",
     *     tags={"Issue"},
     *     @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for testing",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                type="array",
     *                example={{
     *                  "id": "120",
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                      ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Issue id",
     *          required=true,
     *              @OA\Schema(
     *                  type="integer"
     *              )
     *          ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful response",
     *     ),
     *     @OA\Response(
     *        response="500",
     *        description="Server error",
     *     ),
     * )
    */
    public function destroy(IssueDeleteRequest $request, IssueService $service): int
    {
        return $service->deleteIssue($request->input('id'));
    }
}
