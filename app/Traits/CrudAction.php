<?php

namespace App\Traits;

trait CrudAction
{
    /**
     * Store a newly created resource in storage.
     * @param array $data
     * @return Response
     */
    public function storeAction(array $data)
    {
        try {
            $this->model->store($data);
            notify()->success(__('messages.store.success'));
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.store.error'));
        }
        return redirect()->back();
    }

    /**
     * Save a newly created resource in storage.
     * @param array $data
     * @return Response
     */
    public function saveAction(array $data)
    {
        try {
            $this->model->save($data);
            notify()->success(__('messages.save.success'));
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.save.error'));
        }
        return redirect()->back();
    }

     /**
     * Update the specified resource in storage.
     * @param array $data
     * @param int $id
     * @return Response
     */
    public function updateAction(int $id, array $data)
    {
        try {
            $this->model->update($id, $data);
            notify()->success(__('messages.update.success'));
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.update.error'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param string $language
     * @return Response
     */
    public function destroyAction(int $id, ?string $language)
    {
        try {
            $language = (is_null($language)) ? \Translation::getActiveLocale() : $language;
            $this->model->destroy($id, $language);
            notify()->success(__('messages.destroy.success'));
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.destroy.error'));
        }
        return redirect()->back();
    }

    /**
     * Action for batch destroy
     *
     * @param BatchRequest $request
     * @return boolean
     */
    public function batchDestroyAction($request)
    {
        try {
            $this->model->batchDestroy($request->id);
            notify()->success(__('messages.destroy.success'));
            // return true;
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.destroy.error'));
            // return false;
        }
    }

    /**
     * Action for batch publish
     *
     * @param BatchRequest $request
     * @return boolean
     */
    public function batchPublishAction($request)
    {
        try {
            $this->model->batchPublish($request);
            notify()->success(__('messages.publish.success'));
            return true;
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.publish.error'));
            return false;
        }
    }

    /**
     * Action for batch draft
     *
     * @param BatchRequest $request
     * @return boolean
     */
    public function batchDraftAction($request)
    {
        try {
            $this->model->batchDraft($request);
            notify()->success(__('messages.draft.success'));
            return true;
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.draft.error'));
            return false;
        }
    }

}