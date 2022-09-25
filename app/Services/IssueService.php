<?php

namespace App\Services;

use App\Http\Resources\IssueResource;
use App\Models\Issue;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IssueService
{
    /**
     * @return AnonymousResourceCollection
     */
    public function indexIssues(): AnonymousResourceCollection
    {
        return IssueResource::collection(Issue::all());
    }

    /**
     * @param $request
     * @return IssueResource
     */
    public function createIssue($request): IssueResource
    {
        $createdIssue = Issue::create($request->validated());
        return new IssueResource($createdIssue);
    }

    /**
     * @param $id
     * @return IssueResource
     */
    public function showIssue($id): IssueResource
    {
        $issue = Issue::showCurrentIssue($id);
        return new IssueResource($issue);
    }

    /**
     * @param $request
     * @return IssueResource
     */
    public function updateIssue($request): IssueResource
    {
        $issue = Issue::find($request->id);
        $issue->title = $request->title;
        $issue->description = $request->description;

        return new IssueResource($issue);
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteIssue($id): int
    {
        return Issue::destroy($id);
    }
}
