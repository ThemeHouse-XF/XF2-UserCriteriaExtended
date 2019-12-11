<?php

namespace ThemeHouse\UserCriteria\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * Class User
 * @package ThemeHouse\UserCriteria\XF\Entity
 *
 * @property-read integer thuc_warning_count
 * @property-read integer thuc_active_warning_count
 * @property-read integer thuc_expired_warning_count
 * @property-read integer thuc_follower_count
 * @property-read integer thuc_expired_user_upgrade_count
 * @property-read bool thuc_has_active_user_upgrade
 * @property-read integer thuc_next_user_upgrade_expiry_date
 * @property-read integer thuc_tag_count
 * @property-read integer thuc_thread_count
 * @property-read integer thuc_bookmark_count
 * @property-read integer thuc_open_report_count
 * @property-read integer thuc_closed_report_count
 * @property-read integer thuc_report_count
 * @property-read array thuc_trophy_ids
 * @property-read integer thuc_thread_reply_max_count
 * @property-read integer thuc_thread_reply_total_count
 * @property-read bool thuc_has_push_subscription
 * @property-read bool thuc_has_api_key
 * @property-read bool thuc_is_super_admin
 * @property-read int thuc_profile_post_count
 * @property-read int thuc_profile_post_comment_count
 * @property-read int thuc_attachment_count
 *
 * @property-read int thuc_xfrm_resource_download_count
 * @property-read int thuc_xfrm_resource_highest_download_count
 * @property-read int thuc_xfrm_resource_view_count
 * @property-read int thuc_xfrm_resource_highest_view_count
 * @property-read float thuc_xfrm_resource_average_rating
 * @property-read float thuc_xfrm_resource_highest_rating
 * @property-read int thuc_xfrm_resource_update_count
 * @property-read int thuc_xfrm_resource_review_count
 * @property-read int thuc_xfrm_resource_given_review_count
 *
 * @property-read int thuc_xfmg_album_comment_count
 * @property-read int thuc_xfmg_album_highest_comment_count
 * @property-read int thuc_xfmg_album_view_count
 * @property-read int thuc_xfmg_album_highest_view_count
 * @property-read float thuc_xfmg_album_average_rating
 * @property-read float thuc_xfmg_album_highest_rating
 * @property-read int thuc_xfmg_album_rating_count
 * @property-read int thuc_xfmg_album_rating_given_count
 *
 * @property-read int thuc_xfmg_media_item_comment_count
 * @property-read int thuc_xfmg_media_item_highest_comment_count
 * @property-read int thuc_xfmg_media_item_view_count
 * @property-read int thuc_xfmg_media_item_highest_view_count
 * @property-read float thuc_xfmg_media_item_average_rating
 * @property-read float thuc_xfmg_media_item_highest_rating
 * @property-read int thuc_xfmg_media_item_rating_count
 * @property-read int thuc_xfmg_media_item_rating_given_count
 */
class User extends XFCP_User
{
    /**
     * @var
     */
    protected $thuc_user_criteria_cache;

    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {

        $structure = parent::getStructure($structure);

        $structure->getters += [
            'thuc_warning_count' => true,
            'thuc_active_warning_count' => true,
            'thuc_expired_warning_count' => true,
            'thuc_follower_count' => true,
            'thuc_expired_user_upgrade_count' => true,
            'thuc_has_active_user_upgrade' => true,
            'thuc_next_user_upgrade_expiry_date' => true,
            'thuc_tag_count' => true,
            'thuc_thread_count' => true,
            'thuc_bookmark_count' => true,
            'thuc_open_report_count' => true,
            'thuc_closed_report_count' => true,
            'thuc_report_count' => true,
            'thuc_trophy_ids' => true,
            'thuc_thread_reply_max_count' => true,
            'thuc_thread_reply_total_count' => true,
            'thuc_has_push_subscription' => true,
            'thuc_has_api_key' => true,
            'thuc_is_super_admin' => true,
            'thuc_profile_post_count' => true,
            'thuc_profile_post_comment_count' => true,
            'thuc_attachment_count' => true,

            'thuc_xfrm_resource_download_count' => true,
            'thuc_xfrm_resource_highest_download_count' => true,
            'thuc_xfrm_resource_view_count' => true,
            'thuc_xfrm_resource_highest_view_count' => true,
            'thuc_xfrm_resource_average_rating' => true,
            'thuc_xfrm_resource_highest_rating' => true,
            'thuc_xfrm_resource_update_count' => true,
            'thuc_xfrm_resource_review_count' => true,
            'thuc_xfrm_resource_given_review_count' => true,

            'thuc_xfmg_album_comment_count' => true,
            'thuc_xfmg_album_highest_comment_count' => true,
            'thuc_xfmg_album_view_count' => true,
            'thuc_xfmg_album_highest_view_count' => true,
            'thuc_xfmg_album_average_rating' => true,
            'thuc_xfmg_album_highest_rating' => true,
            'thuc_xfmg_album_rating_count' => true,
            'thuc_xfmg_album_rating_given_count' => true,

            'thuc_xfmg_media_item_comment_count' => true,
            'thuc_xfmg_media_item_highest_comment_count' => true,
            'thuc_xfmg_media_item_view_count' => true,
            'thuc_xfmg_media_item_highest_view_count' => true,
            'thuc_xfmg_media_item_average_rating' => true,
            'thuc_xfmg_media_item_highest_rating' => true,
            'thuc_xfmg_media_item_rating_count' => true,
            'thuc_xfmg_media_item_rating_given_count' => true
        ];

        return $structure;
    }

    /**
     * @var integer[]
     */
    protected $postDaysData = [];

    /**
     * @param $days
     * @return integer
     */
    public function getThucPostsDays($days)
    {
        if (!isset($this->postDaysData[$days])) {
            $this->postDaysData[$days] = \XF::db()->fetchOne("
                SELECT
                    count(*)
                FROM
                  xf_post
                WHERE
                  user_id = ?
                  AND message_state = 'visible'
                  AND post_date >= ?
            ", [$this->user_id, \XF::$time - 60 * 60 * 24 * $days]);
        }

        return (int)$this->postDaysData[$days];
    }

    /**
     * @return integer
     */
    public function getThucWarningCount()
    {
        return $this->calcThucWarningAggregates()['total'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucWarningAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['warnings'])) {
            $aggregates = $this->db()->fetchOne('
            SELECT
                COUNT(*) as total,
                COUNT(is_expired) as expired,
                COUNT(!is_expired) as active
            FROM
              xf_warning
            WHERE
              user_id = ?
        ', [$this->user_id]);

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $aggregates);
            } else {
                $aggregates = ['total' => 0, 'expired' => 0, 'active' => 0];
            }

            $this->thuc_user_criteria_cache['warnings'] = $aggregates;
        }
        return $this->thuc_user_criteria_cache['warnings'];
    }

    /**
     * @return integer
     */
    public function getThucActiveWarningCount()
    {
        return $this->calcThucWarningAggregates()['active'];
    }

    /**
     * @return integer
     */
    public function getThucExpiredWarningCount()
    {
        return $this->calcThucWarningAggregates()['expired'];
    }

    /**
     * @return integer
     */
    public function getThucFollowerCount()
    {
        if (!isset($this->thuc_user_criteria_cache['follower_aggregate'])) {
            $this->thuc_user_criteria_cache['follower_aggregate'] = (int)$this->db()->fetchOne('
            SELECT
                COUNT(*)
            FROM
              xf_user_follow
              WHERE
              follow_user_id = ?
        ', [$this->user_id]);
        }
        return $this->thuc_user_criteria_cache['follower_aggregate'];
    }

    /**
     * @return integer
     */
    public function getThucExpiredUserUpgradeCount()
    {
        return $this->calcThucUserUpgradeAggregates()['expired_count'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucUserUpgradeAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['user_upgrades'])) {
            $upgrades = $this->db()->fetchOne('
            SELECT
                SUM(active) > 1 AS has_active,
                MIN(end_date) AS next_expiry_date,
                SUM(!active) AS expired_count
            FROM (
              SELECT 
                end_date,
                1 active
              FROM
                xf_user_upgrade_active
              WHERE
                user_id = ?
            UNION
              SELECT
                ~0 end_date,
                0 active
              FROM
                xf_user_upgrade_expired
              WHERE
                user_id = ?
            ) AS union_table
        ', [$this->user_id, $this->user_id]);

            if (is_array($upgrades)) {
                $this->thuc_user_criteria_cache['user_upgrades'] = array_map('intval', $upgrades);
            } else {
                $this->thuc_user_criteria_cache['user_upgrades'] = [
                    'has_active' => 0,
                    'expired_count' => 0,
                    'next_expiry_date' => PHP_INT_MAX
                ];
            }
        }
        return $this->thuc_user_criteria_cache['user_upgrades'];
    }

    /**
     * @return bool
     */
    public function getThucHasActiveUserUpgrade()
    {
        return (bool)$this->calcThucUserUpgradeAggregates()['has_active'];
    }

    /**
     * @return int
     */
    public function getThucNextUserUpgradeExpiryDate()
    {
        return $this->calcThucUserUpgradeAggregates()['next_expiry_date'];
    }

    /**
     * @return int
     */
    public function getThucTagCount()
    {
        if (!isset($this->thuc_user_criteria_cache['tags'])) {
            $this->thuc_user_criteria_cache['tags'] = (int)$this->db()->fetchOne('
            SELECT
                COUNT(*)
            FROM
              xf_tag_content
            WHERE
              add_user_id = ?
        ', [$this->user_id]);
        }
        return $this->thuc_user_criteria_cache['tags'];
    }

    /**
     * @return int
     */
    public function getThucThreadCount()
    {
        return $this->calcThucThreadAggregates()['total'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucThreadAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['threads'])) {
            $aggregates = $this->db()->fetchPairs("
            SELECT
                node_id,
                COUNT(*) as count
            FROM
              xf_thread
            WHERE
              user_id = ?
              ANd discussion_state = 'visible'
            GROUP BY
              node_id
        ", [$this->user_id]);

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $aggregates);
            } else {
                $aggregates = [];
            }

            $aggregates['total'] = array_sum($aggregates);

            $this->thuc_user_criteria_cache['threads'] = $aggregates;
        }
        return $this->thuc_user_criteria_cache['threads'];
    }

    /**
     * @param $nodeId
     * @return int
     */
    public function getThucNodeThreadCount($nodeId)
    {
        return isset($this->calcThucThreadAggregates()[$nodeId]) ? $this->calcThucThreadAggregates()[$nodeId] : 0;
    }

    /**
     * @param $nodeId
     * @return int
     */
    public function getThucNodePostCount($nodeId)
    {
        return isset($this->calcThucPostAggregates()[$nodeId]) ? $this->calcThucPostAggregates()[$nodeId] : 0;
    }

    /**
     * @return integer[]
     */
    protected function calcThucPostAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['posts'])) {
            $aggregates = $this->db()->fetchPairs("
            SELECT
                thread.node_id,
                COUNT(*) as count
            FROM
              xf_post post
            LEFT JOIN xf_thread thread USING (thread_id)
            WHERE
              post.user_id = ?
              AND post.message_state = 'visible'
              AND thread.discussion_state = 'visible'
            GROUP BY
              thread.node_id
        ", [$this->user_id]);

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $aggregates);
            } else {
                $aggregates = [];
            }

            $this->thuc_user_criteria_cache['posts'] = $aggregates;
        }

        return $this->thuc_user_criteria_cache['posts'];
    }

    /**
     * @return int
     */
    public function getThucBookmarkCount()
    {
        if (!isset($this->thuc_user_criteria_cache['bookmarks'])) {
            $this->thuc_user_criteria_cache['bookmarks'] = (int)$this->db()->fetchOne('
            SELECT
                COUNT(*)
            FROM
              xf_bookmark_item
            WHERE
              user_id = ?
        ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['bookmarks'];
    }

    /**
     * @param $content
     * @return int
     */
    public function getThucWatchCountForContent($content)
    {
        return isset($this->calcThucWatchAggregates()[$content]) ? (int)$this->thuc_user_criteria_cache['watch'][$content] : 0;
    }

    /**
     * @return integer[]
     */
    protected function calcThucWatchAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['watch'])) {
            $addonCache = $this->app()->container('addon.cache');

            $userIdCount = 2;

            if (!empty($addonCache['XFRM'])) {
                $xfrmAggregates = '
                UNION
                    SELECT
                        "xfrm_categories",
                        COUNT(*)
                    FROM
                        xf_rm_category_watch
                    WHERE
                        user_id = ?
                UNION
                    SELECT
                        "xfrm_resources",
                         COUNT(*)
                    FROM
                        xf_rm_resource_watch
                    WHERE
                        user_id = ?
            ';
                $userIdCount += 2;
            } else {
                $xfrmAggregates = '';
            }

            if (!empty($addonCache['XFMG'])) {
                $xfmgAggregates = '
                UNION
                    SELECT
                        "xfmg_categories",
                        COUNT(*)
                    FROM
                        xf_mg_category_watch
                    WHERE
                        user_id = ?
                UNION
                    SELECT
                        "xfmg_albums",
                         COUNT(*)
                    FROM
                        xf_mg_album_watch
                    WHERE
                        user_id = ?
                UNION
                    SELECT
                        "xfmg_media",
                         COUNT(*)
                    FROM
                        xf_mg_media_watch
                    WHERE
                        user_id = ?
            ';
                $userIdCount += 3;
            } else {
                $xfmgAggregates = '';
            }

            /** @noinspection SyntaxError */
            $aggregates = $this->db()->fetchPairs(
                "
                SELECT
                  'forums' index_key,
                  COUNT(*) count
                FROM
                  xf_forum_watch
                WHERE
                  user_id = ?
                UNION
                SELECT
                  'threads',
                  COUNT(*)
                FROM
                  xf_thread_watch
                WHERE
                  user_id = ?
                  "
                . $xfrmAggregates
                . $xfmgAggregates
                , array_fill(0, $userIdCount, $this->user_id));

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $this->thuc_user_criteria_cache['watch']);
            } else {
                $aggregates = [
                    'forums' => 0,
                    'threads' => 0,
                    'xfmg_categories' => 0,
                    'xfmg_albums' => 0,
                    'xfmg_media' => 0,
                    'xfrm_categories' => 0,
                    'xfrm_resources' => 0
                ];
            }

            $this->thuc_user_criteria_cache['watch'] = $aggregates;
        }

        return $this->thuc_user_criteria_cache['watch'];
    }

    /**
     * @return int
     */
    public function getThucReportCount()
    {
        return $this->calcThucReportAggregates()['total'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucReportAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['reports'])) {
            $aggregates = $this->db()->fetchOne("
            SELECT
                COUNT(*) total,
                COUNT(report_state = 'open') open,
                COUNT(report_state <> 'open') closed
            FROM
              xf_report
            WHERE
              content_user_id = ?
        ", $this->user_id);

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $aggregates);
            } else {
                $aggregates = ['open' => 0, 'closed' => 0, 'total' => 0];
            }

            $this->thuc_user_criteria_cache['reports'] = $aggregates;
        }
        return $this->thuc_user_criteria_cache['reports'];
    }

    /**
     * @return int
     */
    public function getThucOpenReportCount()
    {
        if (!$this->thuc_user_criteria_cache['reports']) {
            $this->calcThucReportAggregates();
        }

        return $this->calcThucReportAggregates()['open'];
    }

    /**
     * @return int
     */
    public function getThucClosedReportCount()
    {
        if (!$this->thuc_user_criteria_cache['reports']) {
            $this->calcThucReportAggregates();
        }

        return $this->calcThucReportAggregates()['closed'];
    }

    /**
     * @return array
     */
    public function getThucTrophyIds()
    {
        if (!$this->thuc_user_criteria_cache['trophy_ids']) {
            $this->thuc_user_criteria_cache['trophy_ids'] = $this->db()->fetchAllColumn('
                SELECT
                    trophy_id
                FROM
                  xf_user_trophy
                WHERE
                  user_id = ?
            ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['trophy_ids'];
    }

    /**
     * @return int
     */
    public function getThucThreadReplyTotalCount()
    {
        return $this->calcThucReceivedThreadReplyAggregates()['total'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucReceivedThreadReplyAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['thread_replies'])) {
            $aggregates = $this->db()->fetchRow("
            SELECT
                MAX(reply_count) as max,
                COUNT(*) as total
            FROM
              xf_post post
            JOIN
              xf_thread thread ON (thread.thread_id = post.thread_id && thread.first_post_id != post.post_id)
            WHERE
              thread.user_id = ?
              AND post.user_id <> ?
              AND post.message_state = 'visible'
              AND thread.discussion_state = 'visible'
        ", [$this->user_id, $this->user_id]);

            if (is_array($aggregates)) {
                $aggregates = array_map('intval', $aggregates);
            } else {
                $aggregates = ['max' => 0, 'total' => 0];
            }

            $this->thuc_user_criteria_cache['thread_replies'] = $aggregates;
        }

        return $this->thuc_user_criteria_cache['thread_replies'];
    }

    /**
     * @return int
     */
    public function getThucThreadReplyMaxCount()
    {
        return $this->calcThucReceivedThreadReplyAggregates()['max'];
    }

    /**
     * @return bool
     */
    public function getThucHasPushSubscription()
    {
        if (!isset($this->thuc_user_criteria_cache['push_subscription'])) {
            $this->thuc_user_criteria_cache['push_subscription'] = (bool)$this->db()->fetchOne('
                SELECT
                    COUNT(*)
                FROM
                  xf_user_push_subscription
                WHERE
                  user_id = ?
            ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['push_subscription'];
    }

    /**
     * @return bool
     */
    public function getThucHasApiKey()
    {
        if (!isset($this->thuc_user_criteria_cache['api_key'])) {
            $this->thuc_user_criteria_cache['api_key'] = (bool)$this->db()->fetchOne('
                SELECT
                    COUNT(*)
                FROM
                  xf_api_key
                WHERE
                  user_id = ? AND active
            ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['api_key'];
    }

    /**
     * @return bool
     */
    public function getThucIsSuperAdministrator()
    {
        if (!isset($this->thuc_user_criteria_cache['super_admin'])) {
            $this->thuc_user_criteria_cache['super_admin'] = (bool)$this->db()->fetchOne('
                SELECT
                    is_super_admin
                FROM
                  xf_admin
                WHERE
                  user_id = ?
            ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['super_admin'];
    }

    /**
     * @return int
     */
    public function getThucProfilePostCount()
    {
        if (!isset($this->thuc_user_criteria_cache['profile_posts'])) {
            $this->thuc_user_criteria_cache['profile_posts'] = (int)$this->db()->fetchOne("
                SELECT
                    COUNT(*)
                FROM
                  xf_profile_post
                WHERE
                  user_id = ?
                  AND message_state = 'visible'
            ", $this->user_id);
        }

        return $this->thuc_user_criteria_cache['profile_posts'];
    }

    /**
     * @return int
     */
    public function getThucProfilePostCommentCount()
    {
        if (!isset($this->thuc_user_criteria_cache['profile_post_comments'])) {
            $this->thuc_user_criteria_cache['profile_post_comments'] = (int)$this->db()->fetchOne("
                SELECT
                    COUNT(*)
                FROM
                  xf_profile_post_comment
                WHERE
                  user_id = ?
                  AND message_state = 'visible'
            ", $this->user_id);
        }

        return $this->thuc_user_criteria_cache['profile_post_comments'];
    }

    /**
     * @return int
     */
    public function getThucAttachmentCount()
    {
        if (!isset($this->thuc_user_criteria_cache['attachments'])) {
            $this->thuc_user_criteria_cache['attachments'] = (int)$this->db()->fetchOne('
                SELECT
                    COUNT(*)
                FROM
                  xf_attachment_data
                WHERE
                  user_id = ?
            ', $this->user_id);
        }

        return $this->thuc_user_criteria_cache['attachments'];
    }

    /**
     * @param $reactionId
     * @return int
     */
    public function getThucReceivedReactionCount($reactionId)
    {
        return isset($this->calcThucReceivedReactionAggregates()[$reactionId]) ? $this->calcThucReceivedReactionAggregates()[$reactionId] : 0;
    }

    /**
     * @return integer[]
     */
    protected function calcThucGivenReactionAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['reactions_given'])) {
            $reactions = $this->db()->fetchPairs('
            SELECT
                reaction_id,
                COUNT(*)
            FROM
              xf_reaction_content
            WHERE
              reaction_user_id = ?
            GROUP BY
              reaction_id
        ', $this->user_id);

            if (is_array($reactions)) {
                $reactions = array_map('intval', $reactions);
            } else {
                $reactions = [];
            }

            $this->thuc_user_criteria_cache['reactions_given'] = $reactions;
        }

        return $this->thuc_user_criteria_cache['reactions_given'];
    }

    /**
     * @param $reactionId
     * @return int
     */
    public function getThucGivenReactionCount($reactionId)
    {
        return isset($this->calcThucGivenReactionAggregates()[$reactionId]) ? $this->calcThucGivenReactionAggregates()[$reactionId] : 0;
    }

    /**
     * @param $threadIds
     * @return array
     */
    public function getThucReplyCountsForThreads($threadIds)
    {
        $threadIds = array_filter(array_map("intval", $threadIds));
        $threadIdString = \XF::db()->escapeString(join(',', $threadIds));

        return \XF::db()->fetchPairs("
            SELECT
                thread_id,
                COUNT(*)
            FROM
              xf_post
            WHERE
              user_id = ?
              AND FIND_IN_SET(thread_id, ?)
              AND message_state = 'visible'
            GROUP BY
              thread_id
        ", [$this->user_id, $threadIdString]) + array_fill_keys($threadIds, 0);
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceDownloadCount()
    {
        return (int)$this->calcThucResourceAggregates()['total_downloads'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucResourceAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfrm_aggregates'])) {
            $addonCache = \XF::app()->container('addon.cache');
            $result = null;
            if (isset($addonCache['XFRM'])) {
                $result = $this->db()->fetchRow("
                    SELECT
                        SUM(download_count) AS total_downloads,
                        MAX(download_count) AS highest_downloads,
                        SUM(view_count) AS total_views,
                        MAX(view_count) AS highest_views,
                        AVG(rating_avg) AS average_rating,
                        MAX(rating_avg) AS highest_rating,
                        SUM(update_count) AS update_count,
                        SUM(review_count) AS review_count
                     FROM
                        xf_rm_resource
                    WHERE
                        user_id = ?
                        AND resource_state = 'visible'
                ", $this->user_id);
            }

            if (!isset($addonCache['XFRM']) || !$result) {
                $result = [
                    'total_downloads' => 0,
                    'highest_downloads' => 0,
                    'total_views' => 0,
                    'highest_views' => 0,
                    'average_rating' => 0.0,
                    'highest_rating' => 0.0,
                    'update_count' => 0,
                    'review_count' => 0
                ];
            }

            $this->thuc_user_criteria_cache['xfrm_aggregates'] = $result;
        }

        return $this->thuc_user_criteria_cache['xfrm_aggregates'];
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceHighestDownloadCount()
    {
        return (int)$this->calcThucResourceAggregates()['highest_downloads'];
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceReviewCount()
    {
        return (int)$this->calcThucResourceAggregates()['review_count'];
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceUpdateCount()
    {
        return (int)$this->calcThucResourceAggregates()['update_count'];
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceHighestViewCount()
    {
        return (int)$this->calcThucResourceAggregates()['highest_views'];
    }

    /**
     * @return int
     */
    public function getThucXfrmResourceViewCount()
    {
        return (int)$this->calcThucResourceAggregates()['total_views'];
    }

    /**
     * @return float
     */
    public function getThucXfrmResourceHighestRating()
    {
        return (float)$this->calcThucResourceAggregates()['highest_rating'];
    }

    /**
     * @return float
     */
    public function getThucXfrmResourceAverageRating()
    {
        return (float)$this->calcThucResourceAggregates()['highest_rating'];
    }

    /**
     * @return int
     */
    public function getThucXfrmReviewGivenCount()
    {
        if (!isset($this->thuc_user_criteria_cache['xfrm_reviews_given'])) {
            $addonCache = \XF::app()->container('addon.cache');
            if (isset($addonCache['XFRM'])) {
                $this->thuc_user_criteria_cache['xfrm_reviews_given'] = (int)$this->db()->fetchOne("
                SELECT
                    COUNT(*) AS count
                FROM
                  xf_rm_resource_rating
                JOIN
                  xf_rm_resource USING (resource_id)
                WHERE
                  xf_rm_resource_rating.user_id = ?
                  AND xf_rm_resource_rating.rating_state = 'visible'
                  AND xf_rm_resource.resource_state = 'visible'
            ", $this->user_id);
            } else {
                $this->thuc_user_criteria_cache['xfrm_reviews_given'] = 0;
            }
        }

        return $this->thuc_user_criteria_cache['xfrm_reviews_given'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumCommentCount()
    {
        return (int)$this->calcThucAlbumAggregates()['total_comments'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucAlbumAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfmg_album_aggregates'])) {
            $addonCache = \XF::app()->container('addon.cache');
            $result = null;
            if (isset($addonCache['XFMG'])) {
                $result = $this->db()->fetchRow("
                    SELECT
                        SUM(comment_count) AS total_comments,
                        MAX(comment_count) AS highest_comments,
                        SUM(view_count) AS total_views,
                        MAX(view_count) AS highest_views,
                        AVG(rating_avg) AS average_rating,
                        MAX(rating_avg) AS highest_rating,
                        SUM(rating_count) AS rating_count
                     FROM
                        xf_mg_album
                    WHERE
                        user_id = ?
                        AND album_state = 'visible'
                ", $this->user_id);
            }

            if (!isset($addonCache['XFMG']) || !$result) {
                $result = [
                    'total_comments' => 0,
                    'highest_comments' => 0,
                    'total_views' => 0,
                    'highest_views' => 0,
                    'average_rating' => 0.0,
                    'highest_rating' => 0.0,
                    'rating_count' => 0
                ];
            }

            $this->thuc_user_criteria_cache['xfmg_album_aggregates'] = $result;
        }

        return $this->thuc_user_criteria_cache['xfmg_album_aggregates'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumHighestCommentCount()
    {
        return (int)$this->calcThucAlbumAggregates()['highest_comments'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumViewCount()
    {
        return (int)$this->calcThucAlbumAggregates()['total_views'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumHighestViewCount()
    {
        return (int)$this->calcThucAlbumAggregates()['highest_views'];
    }

    /**
     * @return float
     */
    public function getThucXfmgAlbumAverageRating()
    {
        return (float)$this->calcThucAlbumAggregates()['average_rating'];
    }

    /**
     * @return float
     */
    public function getThucXfmgAlbumHighestRating()
    {
        return (float)$this->calcThucAlbumAggregates()['highest_rating'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumRatingCount()
    {
        return (int)$this->calcThucAlbumAggregates()['rating_count'];
    }

    /**
     * @return int
     */
    public function getThucXfmgAlbumRatingGivenCount()
    {
        return (int)$this->calcThucXFMGRatingsGivenAggregates()['album'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucXFMGRatingsGivenAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfmg_ratings_given'])) {
            $addonCache = \XF::app()->container('addon.cache');
            if (isset($addonCache['XFMG'])) {
                $this->thuc_user_criteria_cache['xfmg_ratings_given'] = $this->db()->fetchOne("
                SELECT
                    COUNT(content_type = 'xfmg_media') media_item,
                    COUNT(content_type = 'xfmg_album') album
                FROM
                  xf_mg_rating
                WHERE
                  user_id = ?
            ", $this->user_id);
            } else {
                $this->thuc_user_criteria_cache['xfmg_ratings_given'] = 0;
            }
        }

        return $this->thuc_user_criteria_cache['xfmg_ratings_given'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemCommentCount()
    {
        return (int)$this->calcThucMediaItemAggregates()['total_comments'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucMediaItemAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfmg_item_aggregates'])) {
            $addonCache = \XF::app()->container('addon.cache');
            $result = null;
            if (isset($addonCache['XFMG'])) {
                $result = $this->db()->fetchRow("
                    SELECT
                        SUM(comment_count) AS total_comments,
                        MAX(comment_count) AS highest_comments,
                        SUM(view_count) AS total_views,
                        MAX(view_count) AS highest_views,
                        AVG(rating_avg) AS average_rating,
                        MAX(rating_avg) AS highest_rating,
                        SUM(rating_count) AS rating_count
                     FROM
                        xf_mg_media_item
                    WHERE
                        user_id = ?
                        AND media_state = 'visible'
                ", $this->user_id);
            }

            if (!isset($addonCache['XFMG']) || !$result) {
                $result = [
                    'total_comments' => 0,
                    'highest_comments' => 0,
                    'total_views' => 0,
                    'highest_views' => 0,
                    'average_rating' => 0.0,
                    'highest_rating' => 0.0,
                    'rating_count' => 0
                ];
            }

            $this->thuc_user_criteria_cache['xfmg_item_aggregates'] = $result;
        }

        return $this->thuc_user_criteria_cache['xfmg_item_aggregates'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemHighestCommentCount()
    {
        return (int)$this->calcThucMediaItemAggregates()['highest_comments'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemViewCount()
    {
        return (int)$this->calcThucMediaItemAggregates()['total_views'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemHighestViewCount()
    {
        return (int)$this->calcThucMediaItemAggregates()['highest_views'];
    }

    /**
     * @return float
     */
    public function getThucXfmgMediaItemAverageRating()
    {
        return (float)$this->calcThucMediaItemAggregates()['average_rating'];
    }

    /**
     * @return float
     */
    public function getThucXfmgMediaItemHighestRating()
    {
        return (float)$this->calcThucMediaItemAggregates()['highest_rating'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemRatingCount()
    {
        return (int)$this->calcThucMediaItemAggregates()['rating_count'];
    }

    /**
     * @return int
     */
    public function getThucXfmgMediaItemRatingGivenCount()
    {
        return (int)$this->calcThucXFMGRatingsGivenAggregates()['media_item'];
    }

    /**
     * @param $categoryId
     * @return int
     */
    public function getThucXfrmResourceCountForCategory($categoryId)
    {
        return isset($this->calcThucResourceCategoryAggregates()[$categoryId]) ? $this->calcThucResourceCategoryAggregates()[$categoryId] : 0;
    }

    /**
     * @return integer[]
     */
    protected function calcThucResourceCategoryAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfrm_category_resource_aggregates'])) {
            $addonCache = \XF::app()->container('addon.cache');
            if (isset($addonCache['XFRM'])) {
                $aggregates = $this->db()->fetchPairs("
                SELECT
                    resource_category_id,
                    COUNT(*) AS count
                FROM
                  xf_rm_resource
                WHERE
                  user_id = ?
                  AND resource_state = 'visible'
            ", $this->user_id);
            } else {
                $aggregates = [];
            }

            $this->thuc_user_criteria_cache['xfrm_category_resource_aggregates'] = array_map("intval", $aggregates);
        }

        return $this->thuc_user_criteria_cache['xfrm_category_resource_aggregates'];
    }

    /**
     * @param $categoryId
     * @return int
     */
    public function getThucXfmgItemCountForCategory($categoryId)
    {
        return isset($this->calcThucMediaCategoryAggregates()[$categoryId]) ? $this->calcThucMediaCategoryAggregates()[$categoryId] : 0;
    }

    /**
     * @return integer[]
     */
    protected function calcThucMediaCategoryAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['xfmg_category_item_aggregates'])) {
            $addonCache = \XF::app()->container('addon.cache');
            if (isset($addonCache['XFMG'])) {
                $aggregates = $this->db()->fetchPairs("
                SELECT
                    category_id,
                    COUNT(*) AS count
                FROM
                  xf_mg_media_item
                WHERE
                  user_id = ?
                  AND media_state = 'visible'
            ", $this->user_id);

                $this->thuc_user_criteria_cache['xfmg_category_item_aggregates'] = array_map("intval", $aggregates);
            } else {
                $this->thuc_user_criteria_cache['xfmg_category_item_aggregates'] = [];
            }
        }

        return $this->thuc_user_criteria_cache['xfmg_category_item_aggregates'];
    }

    /**
     * @return integer[]
     */
    protected function calcThucReceivedReactionAggregates()
    {
        if (!isset($this->thuc_user_criteria_cache['reactions_received'])) {
            $reactions = $this->db()->fetchPairs('
            SELECT
                reaction_id,
                COUNT(*)
            FROM
              xf_reaction_content
            WHERE
              content_user_id = ?
            GROUP BY
              reaction_id
        ', $this->user_id);

            if (is_array($reactions)) {
                $reactions = array_map('intval', $reactions);
            } else {
                $reactions = [];
            }

            $this->thuc_user_criteria_cache['reactions_received'] = $reactions;
        }

        return $this->thuc_user_criteria_cache['reactions_received'];
    }
}
